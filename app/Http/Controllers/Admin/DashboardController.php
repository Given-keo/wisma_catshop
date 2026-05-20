<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPelanggan = User::where('role', 'user')->count();

        $kucingDititipkan = Booking::whereHas('service', function ($query) {
                $query->where('type', 'boarding');
            })
            ->whereIn('status', ['dp_paid', 'fully_paid'])
            ->where('start_date', '<=', Carbon::now()->format('Y-m-d'))
            ->where(function ($query) {
                $query->whereNull('end_date')
                      ->orWhere('end_date', '>=', Carbon::now()->format('Y-m-d'));
            })
            ->count();

        $menungguKonfirmasi = Booking::where('status', 'waiting_confirmation')->count();

        $pendapatanBulanIni = Booking::whereIn('status', ['fully_paid', 'completed'])
            ->whereMonth('start_date', Carbon::now()->month)
            ->whereYear('start_date', Carbon::now()->year)
            ->sum('total_price');

        $transaksiTerbaru = Booking::with(['user', 'service'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard.index', compact(
            'totalPelanggan', 
            'kucingDititipkan', 
            'menungguKonfirmasi', 
            'pendapatanBulanIni', 
            'transaksiTerbaru'
        ));
    }
}