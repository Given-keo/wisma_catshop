<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BoardingLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerBoardingLogController extends Controller
{
    public function index($booking_id)
    {
        $booking = Booking::with(['cat', 'service'])
            ->where('id', $booking_id)
            ->where('user_id', Auth::id())
            ->whereHas('service', function ($query) {
                $query->where('type', 'boarding');
            })
            ->firstOrFail(); 
            
        $logs = BoardingLog::where('booking_id', $booking_id)
            ->orderBy('log_date', 'desc')
            ->get();

        return view('customer.boardings.logs', compact('booking', 'logs'));
    }
}