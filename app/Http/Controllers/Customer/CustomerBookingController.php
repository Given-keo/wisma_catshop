<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cats;
use App\Models\Service;
use App\Models\Booking; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CustomerBookingController extends Controller
{

    public function index()
    {
        $bookings = Booking::with(['cat', 'service'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('customer.bookings.index', compact('bookings'));
    }

    public function create()
    {

        $cats = Cats::where('user_id', Auth::id())->get();

        $services = Service::where('is_active', true)->get();

        return view('customer.bookings.create', compact('cats', 'services'));
    }


    public function store(Request $request)
    {
        
        $request->validate([
            'cat_id' => 'required|exists:cats,id',
            'service_id' => 'required|exists:services,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'total_price' => 'required|numeric',
            'brought_items' => 'nullable|string',
        ]);

        // Generate Booking Code WSM-20260520-XXXXX)
        $bookingCode = 'WSM-' . date('Ymd') . '-' . strtoupper(Str::random(5));

        $booking = Booking::create([
            'booking_code' => $bookingCode,
            'user_id' => Auth::id(),
            'cat_id' => $request->cat_id,
            'service_id' => $request->service_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_price' => $request->total_price,
            'brought_items' => $request->brought_items,
            'status' => 'pending_payment', 
            'is_walk_in' => false, 
        ]);

        return redirect()->route('customer.bookings.show', $booking->id)
            ->with('success', 'Booking berhasil dibuat! Silakan lakukan pembayaran via QRIS.');
    }

    public function show($id)
    {
        $booking = Booking::with(['cat', 'service'])
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('customer.bookings.show', compact('booking'));
    }

    /**
     * Mengunggah bukti pembayaran QRIS
     */
    public function uploadPayment(Request $request, $id)
    {
        // 1. Pastikan booking ini ada dan memang milik user yang sedang login
        $booking = Booking::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // 2. Pastikan statusnya memang masih menunggu pembayaran
        if ($booking->status !== 'pending_payment') {
            return redirect()->back()->with('error', 'Pesanan ini tidak dalam status menunggu pembayaran.');
        }

        // 3. Validasi input file dari form
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Wajib gambar, maks 2MB
        ], [
            'payment_proof.required' => 'Anda harus melampirkan gambar bukti transfer.',
            'payment_proof.image' => 'File yang diunggah harus berupa gambar.',
            'payment_proof.max' => 'Ukuran gambar maksimal adalah 2MB.',
        ]);

        // 4. Proses simpan gambar ke storage server
        if ($request->hasFile('payment_proof')) {
            // Disimpan di folder storage/app/public/payment_proofs
            $filePath = $request->file('payment_proof')->store('payment_proofs', 'public');
            
            // 5. Update data booking di database
            $booking->update([
                'payment_proof' => $filePath,
                'status' => 'waiting_confirmation' // Status berubah!
            ]);

            return redirect()->back()
                ->with('success', 'Bukti pembayaran berhasil diunggah! Mohon tunggu konfirmasi dari Admin.');
        }

        return redirect()->back()->with('error', 'Gagal mengunggah file. Silakan coba lagi.');
    }
}