<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function keuangan(Request $request)
    {
        $startDate = $request->start_date ?? Carbon::now()->startOfMonth()->format('Y-m-d');
        $endDate = $request->end_date ?? Carbon::now()->format('Y-m-d');

        $bookings = Booking::with(['user', 'service'])
            ->whereIn('status', ['fully_paid', 'completed', 'dp_paid'])
            ->whereBetween('start_date', [$startDate, $endDate])
            ->latest('start_date')
            ->get();

        $totalPendapatan = $bookings->sum('total_price');

        return view('admin.laporan.keuangan', compact('bookings', 'startDate', 'endDate', 'totalPendapatan'));
    }

    public function layanan(Request $request)
    {
        $startDate = $request->start_date ?? Carbon::now()->startOfMonth()->format('Y-m-d');
        $endDate = $request->end_date ?? Carbon::now()->format('Y-m-d');

        $popularServices = Service::select('services.id', 'services.name', 'services.type', 'services.price')
            ->withCount(['bookings as total_pesanan' => function ($query) use ($startDate, $endDate) {
                $query->whereIn('status', ['fully_paid', 'completed', 'dp_paid'])
                      ->whereBetween('start_date', [$startDate, $endDate]);
            }])
            
            ->withSum(['bookings as total_pendapatan' => function ($query) use ($startDate, $endDate) {
                $query->whereIn('status', ['fully_paid', 'completed', 'dp_paid'])
                      ->whereBetween('start_date', [$startDate, $endDate]);
            }], 'total_price')
            ->orderByDesc('total_pesanan')
            ->get();

        return view('admin.laporan.layanan', compact('popularServices', 'startDate', 'endDate'));
    }
}