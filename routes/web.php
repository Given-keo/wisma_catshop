<?php

use App\Http\Controllers\Admin\BoardingLogController;
use App\Http\Controllers\Admin\BookingController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\CatsController;
use App\Http\Controllers\Admin\PelangganController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Customer\CustomerBoardingLogController;
use App\Http\Controllers\Customer\CustomerBookingController;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboardController;
use App\Http\Controllers\Customer\CustomerCatController;
use App\Http\Controllers\Customer\CustomerProfileController;

// Landing Page
Route::get('/', function () {
    return view('welcome');
});


// Profile
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

// Area User / Pelanggan
Route::middleware(['auth', 'verified', 'role:user'])
    ->prefix('customer')
    ->name('customer.') 
    ->group(function () {

        // 1. Dashboard Pelanggan
        Route::get('/dashboard', [CustomerDashboardController::class, 'index'])
            ->name('dashboard');
        // 2. Profil & Data Kucing (CRUD Kucing Milik Pelanggan)
        Route::prefix('cats')
            ->name('cats.')
            ->controller(CustomerCatController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::get('/{id}/edit', 'edit')->name('edit');
                Route::put('/{id}', 'update')->name('update');
                Route::delete('/{id}', 'destroy')->name('destroy');
            });

        // 3. Booking & Transaksi Pelanggan
        Route::prefix('bookings')
            ->name('bookings.')
            ->controller(CustomerBookingController::class)
            ->group(function () {
                // Riwayat Booking
                Route::get('/', 'index')->name('index'); 
                
                // Wizard Booking 4 Langkah (Bisa menggunakan 1 method create yang menangani step)
                Route::get('/create', 'create')->name('create'); 
                Route::post('/', 'store')->name('store'); 
                
                // Detail Booking & Upload Bukti Bayar
                Route::get('/{id}', 'show')->name('show'); 
                Route::post('/{id}/payment-proof', 'uploadPayment')->name('upload_payment'); 
            });

        // 4. Status Penitipan (Melihat Log Harian dari Admin)
        Route::get('/boardings/{booking_id}/logs', [CustomerBoardingLogController::class, 'index'])
            ->name('boardings.logs');


        // 5. Profil Pelanggan
        Route::get('/profile', [CustomerProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [CustomerProfileController::class, 'update'])->name('profile.update');

    });



// Admin
Route::middleware(['auth', 'verified', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');
        // Data Master
        Route::prefix('data-master')
            ->name('data-master.')
            ->group(function () {

                // SERVICES
                Route::prefix('services')
                    ->name('services.')
                    ->controller(ServicesController::class)
                    ->group(function () {

                        Route::get('/', 'index')->name('index');
                        Route::post('/', 'store')->name('store');
                        Route::delete('/{id}/destroy', 'destroy')->name('destroy');
                    });


                // CATS
                Route::prefix('cats')
                    ->name('cats.')
                    ->controller(CatsController::class)
                    ->group(function () {

                        Route::get('/', 'index')->name('index');
                        Route::post('/', 'store')->name('store');
                        Route::delete('/{id}/destroy', 'destroy')->name('destroy');
                    });


                // PELANGGAN
                Route::prefix('users')
                    ->name('users.')
                    ->controller(PelangganController::class)
                    ->group(function () {

                        Route::get('/', 'index')->name('index');
                        Route::post('/', 'store')->name('store');
                        Route::delete('/{id}/destroy', 'destroy')->name('destroy');
                    });
            });

        // Transaksi
        Route::prefix('transaksi')
            ->name('transaksi.')
            ->group(function () {

                // BOOKINGS (RESERVASI & KASIR WALK-IN)
                Route::prefix('bookings')
                    ->name('bookings.')
                    ->controller(BookingController::class)
                    ->group(function () {
                        // Menampilkan daftar semua transaksi/booking
                        Route::get('/', 'index')->name('index'); 
                        Route::get('/create', 'create')->name('create'); 
                        Route::post('/', 'store')->name('store'); 
                        Route::get('/{id}', 'show')->name('show'); 
                        Route::put('/{id}/status', 'updateStatus')->name('update-status'); 
                    });

                // BOARDING LOGS (LAPORAN HARIAN PENITIPAN)
                Route::prefix('boarding-logs')
                    ->name('boarding_logs.')
                    ->controller(BoardingLogController::class)
                    ->group(function () {
                        Route::get('/', 'index')->name('index'); 
                        Route::get('/{booking_id}/create', 'create')->name('create'); 
                        Route::post('/{booking_id}', 'store')->name('store'); 
                        Route::get('/{booking_id}/history', 'history')->name('history'); 
                    });
            });


        // LAPORAN
        Route::prefix('laporan')
            ->name('laporan.')
            ->controller(ReportController::class)
            ->group(function () {
                Route::get('/keuangan', 'keuangan')->name('keuangan');
                Route::get('/layanan', 'layanan')->name('layanan');
            });



    });


require __DIR__ . '/auth.php';