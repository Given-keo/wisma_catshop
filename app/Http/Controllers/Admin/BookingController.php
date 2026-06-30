<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\BoardingLog;
use App\Models\Booking;
use App\Models\User;
use App\Models\Cats;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookingController extends Controller
{

    public function index()
    {
        $bookings = Booking::with(['user', 'cat', 'service'])->latest()->get();

        return view('admin.transaksi.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $users = User::where('role', 'user')->get();
        $cats = Cats::all();
        $services = Service::where('is_active', true)->get();

        return view('admin.transaksi.bookings.create', compact('users', 'cats', 'services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'cat_id' => 'required|exists:cats,id',
            'service_id' => 'required|exists:services,id',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'total_price' => 'required|numeric|min:0',
            'brought_items' => 'nullable|string',
        ]);

        // Generate Booking Code unik WSM-20260517-XYZ12
        $bookingCode = 'WSM-' . date('Ymd') . '-' . strtoupper(Str::random(5));

        // Tentukan down_payment & status berdasarkan tipe layanan
        $service = Service::findOrFail($request->service_id);

        if ($service->type === 'grooming') {
            // Grooming: bayar lunas
            $downPayment = $request->total_price;
            $status = 'fully_paid';
        } else {
            // Boarding: DP 50%, jika bayar lebih anggap pelunasan
            $downPayment = $request->total_price * 50 / 100;
            $status = 'dp_paid';
        }

        Booking::create([
            'booking_code' => $bookingCode,
            'user_id' => $request->user_id,
            'cat_id' => $request->cat_id,
            'service_id' => $request->service_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_price' => $request->total_price,
            'down_payment' => $downPayment,
            'brought_items' => $request->brought_items,
            'status' => $status,
            'is_walk_in' => true, 
            'is_reward_claimed' => false, 
        ]);

        return redirect()->route('admin.transaksi.bookings.index')
            ->with('success', 'Booking walk-in berhasil ditambahkan!');
    }

    public function show($id)
    {
        $booking = Booking::with(['user', 'cat', 'service'])->findOrFail($id);

        return view('admin.transaksi.bookings.show', compact('booking'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending_payment,waiting_confirmation,dp_paid,fully_paid,completed,cancelled'
        ]);

        $booking = Booking::findOrFail($id);
        $booking->update([
            'status' => $request->status
        ]);

        if ($request->status === 'completed' && !$booking->is_reward_claimed) {
            $user = User::find($booking->user_id);
            if ($user) {
                $user->increment('loyalty_points', 10); 
            }
        }

        return redirect()->back()
            ->with('success', 'Status booking berhasil diperbarui!');
    }

    public function boardingLogs()
    {
        return $this->hasMany(BoardingLog::class);
    }
}