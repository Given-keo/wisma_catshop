<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cat;
use App\Models\Booking;
use App\Models\Cats; // Pastikan nama model benar, biasanya singular 'Cat' bukan 'Cats'

class DashboardController extends Controller
{

    public function index()
    {

        $user = Auth::user();

        $catsCount = Cats::where('user_id', $user->id)->count();

        $activeBookings = Booking::with(['cat', 'service'])
            ->where('user_id', $user->id)
            ->whereNotIn('status', ['completed', 'cancelled'])
            ->orderBy('start_date', 'asc')
            ->get();

        $recentBookings = Booking::with(['cat', 'service'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('customer.dashboard.index', compact(
            'user', 
            'catsCount', 
            'activeBookings', 
            'recentBookings'
        ));
    }
}