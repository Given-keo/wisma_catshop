<?php

namespace App\View\Components\Customer;

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
                "icon" => "fas fa-home", 
                "route_active" => "customer.dashboard",
                "route_name" => "customer.dashboard",
                "is_dropdown" => false
            ],
            [
                "label" => "Data Kucingku",
                "icon" => "fas fa-cat",
                "route_active" => "customer.cats.*",
                "route_name" => "customer.cats.index",
                "is_dropdown" => false
            ],
            [
                "label" => "Booking Layanan",
                "icon" => "fas fa-calendar-plus",
                "route_active" => "customer.bookings.create",
                "route_name" => "customer.bookings.create",
                "is_dropdown" => false
            ],
            [
                "label" => "Riwayat Transaksi",
                "icon" => "fas fa-receipt",
                "route_active" => ["customer.bookings.index", "customer.bookings.show", "customer.bookings.upload_payment"], 
                "route_name" => "customer.bookings.index",
                "is_dropdown" => false
            ],
            [
                "label" => "Profil Saya",
                "icon" => "fas fa-user-cog",
                "route_active" => "customer.profile.*",
                "route_name" => "customer.profile.edit",
                "is_dropdown" => false
            ],
        ];
    }

    public function render(): View|Closure|string
    {
        return view('components.customer.aside');
    }
}