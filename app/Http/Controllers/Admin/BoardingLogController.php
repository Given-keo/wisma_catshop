<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BoardingLog;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BoardingLogController extends Controller
{
    public function index()
    {
    
        $bookings = Booking::with(['user', 'cat', 'service'])
            ->whereHas('service', function ($query) {
                $query->where('type', 'boarding');
            })
            ->whereIn('status', ['dp_paid', 'fully_paid']) 
            ->latest()
            ->get();

        return view('admin.transaksi.boarding_logs.index', compact('bookings'));
    }


    public function create($booking_id)
    {
        $booking = Booking::with(['user', 'cat'])->findOrFail($booking_id);

        return view('admin.transaksi.boarding_logs.create', compact('booking'));
    }


    public function store(Request $request, $booking_id)
    {
        $request->validate([
            'log_date'         => 'required|date',
            'eating_condition' => 'required|string|max:255',
            'activity'         => 'required|string|max:255',
            'health_notes'     => 'nullable|string',
        ]);

        $booking = Booking::findOrFail($booking_id);

        BoardingLog::create([
            'booking_id'       => $booking->id,
            'log_date'         => $request->log_date,
            'eating_condition' => $request->eating_condition,
            'activity'         => $request->activity,
            'health_notes'     => $request->health_notes,
        ]);

        return redirect()->route('admin.transaksi.boarding_logs.history', $booking->id)
            ->with('success', 'Log laporan harian berhasil ditambahkan!');
    }

    public function history($booking_id)
    {
        $booking = Booking::with(['user', 'cat', 'service'])->findOrFail($booking_id);
        

        $logs = BoardingLog::where('booking_id', $booking_id)
            ->orderBy('log_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.transaksi.boarding_logs.history', compact('booking', 'logs'));
    }
}