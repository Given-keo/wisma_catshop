<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Aside extends Component
{
    public $routes;

    public function __construct()
    {
        $this->routes = [
            [
                "label" => "Dashboard",
                "icon" => "fas fa-laptop",
                "route_name" => "admin.dashboard",
                "route_active" => "admin.dashboard",
                "is_dropdown" => false
            ],

            [
                "label" => "Data Master",
                "icon" => "fas fa-database",
                "route_active" => "data-master.*",
                "is_dropdown" => true,
                "dropdown" => [
                    [
                        "label" => "Pelanggan",
                        "route_active" => "admin.data-master.users.*",
                        "route_name" => "admin.data-master.users.index",
                    ],


                    [
                        "label" => "Kucing",
                        "route_active" => "admin.data-master.cats.*",
                        "route_name" => "admin.data-master.cats.index",
                    ],

                    [
                        "label" => "Layanan",
                        "route_active" => "admin.data-master.services.*",
                        "route_name" => "admin.data-master.services.index",
                    ],

                   

                ]
            ],

            // TRANSAKSI
            [
                "label" => "Transaksi",
                "icon" => "fas fa-exchange-alt",
                "route_active" => "admin.transaksi.*", 
                "is_dropdown" => true,
                "dropdown" => [
                    [
                        "label" => "Daftar Booking & Kasir",
                        "route_active" => "admin.transaksi.bookings.*",
                        "route_name" => "admin.transaksi.bookings.index",
                    ],
                    [
                        "label" => "Log Penitipan (Boarding)",
                        "route_active" => "admin.transaksi.boarding_logs.*",
                        "route_name" => "admin.transaksi.boarding_logs.index",
                    ],
                ]
            ],

            [
                "label" => "Laporan",
                "icon" => "fas fa-chart-line",
                "route_active" => "admin.laporan.*", 
                "is_dropdown" => true,
                "dropdown" => [
                    [
                        "label" => "Laporan Pendapatan",
                        "route_active" => "admin.laporan.keuangan",
                        "route_name" => "admin.laporan.keuangan",
                    ],
                    [
                        "label" => "Layanan Terpopuler",
                        "route_active" => "admin.laporan.layanan",
                        "route_name" => "admin.laporan.layanan",
                    ],
                ]
            ],

        ];
    }

    public function render(): View|Closure|string
    {
        return view('components.admin.aside');
    }
}
