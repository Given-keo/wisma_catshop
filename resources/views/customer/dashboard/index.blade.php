@extends("customer.layouts.app") 
@section("content_title","Dashboard Pelanggan")

@section("content")
<style>
    :root {
        --brand-orange: #ff4a17;
        --brand-orange-light: rgba(255, 74, 23, 0.1);
        --brand-orange-hover: #e63e0d;
    }
    
    .text-brand { color: var(--brand-orange) !important; }
    .bg-light-brand { background-color: var(--brand-orange-light) !important; }
    
    .btn-brand {
        background-color: var(--brand-orange);
        color: #ffffff;
        border: none;
        transition: all 0.3s ease;
    }
    .btn-brand:hover {
        background-color: var(--brand-orange-hover);
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(255, 74, 23, 0.3);
    }
    .btn-outline-brand {
        color: var(--brand-orange);
        border: 1px solid var(--brand-orange);
        transition: all 0.3s ease;
    }
    .btn-outline-brand:hover {
        background-color: var(--brand-orange);
        color: #ffffff;
    }

    .hover-elevate {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-elevate:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1) !important;
    }

    .table-modern td, .table-modern th {
        vertical-align: middle;
        padding: 1rem;
    }
    .table-modern tbody tr {
        transition: background-color 0.2s ease;
    }
    .table-modern tbody tr:hover {
        background-color: #f8f9fc;
    }
</style>

<div class="row mb-4">
    <div class="col-12">
        <div class="card shadow-sm border-0 hover-elevate" style="background: linear-gradient(135deg, #ff4a17, #ff7a55); color: #ffffff; border-radius: 15px; overflow: hidden;">
            <div class="card-body p-4 p-md-5 position-relative">
                <div class="row align-items-center relative z-1">
                    <div class="col-md-8">
                        <span class="badge bg-white text-brand mb-2 px-3 py-2 rounded-pill fw-bold" style="letter-spacing: 1px; font-size: 0.75rem;">
                            <i class="fas fa-sun me-1"></i> SELAMAT DATANG KEMBALI
                        </span>
                        <h2 class="display-6 fw-bold mb-3 text-white">Halo, {{ $user->name ?? 'Kak' }}! 👋</h2>
                        <p class="mb-0 fs-6" style="opacity: 0.9; max-width: 500px;">
                            Pantau kondisi anabul kesayangan, kelola data kucing, dan lakukan booking layanan grooming atau penitipan dengan mudah di sini.
                        </p>
                    </div>
                </div>
                <div class="position-absolute d-none d-md-block" style="right: 5%; top: 50%; transform: translateY(-50%); opacity: 0.15; color: #ffffff;">
                    <i class="fas fa-cat" style="font-size: 8rem;"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4 g-4">
    <div class="col-md-4 col-sm-12">
        <div class="card border-0 shadow-sm h-100 hover-elevate" style="border-radius: 12px;">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="bg-light-brand text-brand rounded-circle d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 60px; height: 60px;">
                    <i class="fas fa-gift fs-3"></i>
                </div>
                <div>
                    <p class="text-muted mb-1 small text-uppercase fw-bold">Poin Loyalitas</p>
                    <h3 class="mb-0 fw-bold text-dark">{{ $user->loyalty_points ?? 0 }} <span class="fs-6 text-muted fw-normal">Poin</span></h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-sm-12">
        <div class="card border-0 shadow-sm h-100 hover-elevate" style="border-radius: 12px;">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="bg-light text-info rounded-circle d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 60px; height: 60px; background-color: rgba(23, 162, 184, 0.1) !important;">
                    <i class="fas fa-paw fs-3"></i>
                </div>
                <div>
                    <p class="text-muted mb-1 small text-uppercase fw-bold">Kucing Terdaftar</p>
                    <h3 class="mb-0 fw-bold text-dark">{{ $catsCount ?? 0 }} <span class="fs-6 text-muted fw-normal">Ekor</span></h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-sm-12">
        <div class="card border-0 shadow-sm h-100 hover-elevate" style="border-radius: 12px;">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="bg-light text-warning rounded-circle d-flex align-items-center justify-content-center me-3 shadow-sm" style="width: 60px; height: 60px; background-color: rgba(255, 193, 7, 0.1) !important;">
                    <i class="fas fa-calendar-check fs-3"></i>
                </div>
                <div>
                    <p class="text-muted mb-1 small text-uppercase fw-bold">Booking Aktif</p>
                    <h3 class="mb-0 fw-bold text-dark">{{ $activeBookings->count() ?? 0 }} <span class="fs-6 text-muted fw-normal">Pesanan</span></h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm border-0" style="border-radius: 15px; overflow: hidden;">
            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3 border-0">
                <h5 class="mb-0 fw-bold text-gray-800"><i class="fas fa-history text-brand me-2"></i>Transaksi Terakhir Anda</h5>
                <a href="{{ route('customer.bookings.index') }}" class="btn btn-sm btn-outline-brand rounded-pill px-3">Lihat Semua</a>
            </div>
            
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-modern table-borderless mb-0 align-middle">
                        <thead class="bg-light text-muted small text-uppercase">
                            <tr>
                                <th class="ps-4">Tanggal Masuk</th>
                                <th>Kode Booking</th>
                                <th>Anabul</th>
                                <th>Layanan</th>
                                <th>Status</th>
                                <th class="text-end pe-4">Total Biaya</th>
                            </tr>
                        </thead>
                        <tbody class="border-top">
                            @forelse($recentBookings ?? [] as $trx)
                                <tr class="border-bottom">
                                    <td class="ps-4">
                                        <div class="fw-bold text-dark">{{ \Carbon\Carbon::parse($trx->start_date)->format('d M Y') }}</div>
                                    </td>
                                    <td>
                                        <a href="{{ route('customer.bookings.show', $trx->id) }}" class="fw-bold text-decoration-none text-brand">
                                            {{ $trx->booking_code }}
                                        </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px;">
                                                <i class="fas fa-cat text-secondary"></i>
                                            </div>
                                            <span class="fw-bold text-gray-800">{{ $trx->cat->name ?? '-' }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-dark">{{ $trx->service->name ?? '-' }}</div>
                                        <small class="text-muted text-capitalize">{{ $trx->service->type ?? '' }}</small>
                                    </td>
                                    <td>
                                        @php
                                            $statusBadge = match($trx->status) {
                                                'pending_payment' => '<span class="badge bg-warning text-dark px-3 py-2 rounded-pill"><i class="fas fa-wallet me-1"></i> Menunggu Pembayaran</span>',
                                                'waiting_confirmation' => '<span class="badge bg-info text-white px-3 py-2 rounded-pill"><i class="fas fa-clock me-1"></i> Menunggu Konfirmasi</span>',
                                                'dp_paid' => '<span class="badge bg-light-brand text-brand border border-warning px-3 py-2 rounded-pill"><i class="fas fa-check-circle me-1"></i> DP Dibayar</span>',
                                                'fully_paid' => '<span class="badge bg-success text-white px-3 py-2 rounded-pill"><i class="fas fa-check-double me-1"></i> Lunas</span>',
                                                'completed' => '<span class="badge bg-secondary text-white px-3 py-2 rounded-pill"><i class="fas fa-flag-checkered me-1"></i> Selesai</span>',
                                                'cancelled' => '<span class="badge bg-danger text-white px-3 py-2 rounded-pill"><i class="fas fa-times me-1"></i> Dibatalkan</span>',
                                                default => '<span class="badge bg-light text-dark px-3 py-2 rounded-pill">' . $trx->status . '</span>'
                                            };
                                        @endphp
                                        {!! $statusBadge !!}
                                    </td>
                                    <td class="text-end pe-4 fw-bold text-success fs-6">
                                        Rp {{ number_format($trx->total_price, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="d-flex flex-column align-items-center justify-content-center">
                                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                                <i class="fas fa-box-open fs-1 text-muted"></i>
                                            </div>
                                            <h6 class="fw-bold text-dark">Belum ada transaksi</h6>
                                            <p class="text-muted small mb-3">Sepertinya Anda belum pernah melakukan pemesanan layanan.</p>
                                            <a href="{{ route('customer.bookings.create') }}" class="btn btn-brand rounded-pill px-4">
                                                <i class="fas fa-plus me-1"></i> Booking Sekarang
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection