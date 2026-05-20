@extends('customer.layouts.app') 
@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Riwayat Booking & Transaksi</h2>
        <a href="{{ route('customer.bookings.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-calendar-plus fa-sm text-white-50"></i> Buat Booking Baru
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow mb-4 border-0">
        <div class="card-header py-3 bg-white">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Transaksi Anda</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="dataTable" width="100%" cellspacing="0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-3">Kode Booking</th>
                            <th>Kucing</th>
                            <th>Layanan</th>
                            <th>Tanggal Masuk</th>
                            <th>Total Biaya</th>
                            <th>Status</th>
                            <th class="text-center pe-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bookings as $booking)
                            <tr>
                                <td class="fw-bold ps-3 text-secondary">
                                    {{ $booking->booking_code }}
                                </td>
                                
                                <td>
                                    <span class="badge bg-light text-dark border p-2">
                                        🐾 {{ $booking->cat->name ?? 'Kucing Terhapus' }}
                                    </span>
                                </td>
                                
                                <td>
                                    <div>{{ $booking->service->name ?? 'Layanan' }}</div>
                                    <small class="text-muted text-capitalize">({{ $booking->service->type ?? '-' }})</small>
                                </td>
                                
                                <td>
                                    <div>{{ \Carbon\Carbon::parse($booking->start_date)->format('d M Y') }}</div>
                                    @if($booking->end_date)
                                        <small class="text-muted">s/d {{ \Carbon\Carbon::parse($booking->end_date)->format('d M Y') }}</small>
                                    @endif
                                </td>
                                
                                <td class="fw-bold text-dark">
                                    Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                </td>
                                
                                <td>
                                    @switch($booking->status)
                                        @case('pending_payment')
                                            <span class="badge bg-warning text-dark"><i class="fas fa-wallet me-1"></i> Menunggu Pembayaran</span>
                                            @break
                                        @case('waiting_confirmation')
                                            <span class="badge bg-info text-white"><i class="fas fa-clock me-1"></i> Menunggu Konfirmasi</span>
                                            @break
                                        @case('dp_paid')
                                            <span class="badge bg-primary text-white"><i class="fas fa-check-circle me-1"></i> DP Dibayar</span>
                                            @break
                                        @case('fully_paid')
                                            <span class="badge bg-success text-white"><i class="fas fa-check-double me-1"></i> Lunas</span>
                                            @break
                                        @case('completed')
                                            <span class="badge bg-secondary text-white"><i class="fas fa-flag-checkered me-1"></i> Selesai</span>
                                            @break
                                        @case('cancelled')
                                            <span class="badge bg-danger text-white"><i class="fas fa-times-circle me-1"></i> Dibatalkan</span>
                                            @break
                                    @endswitch
                                </td>
                                
                                <td class="text-center pe-3">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('customer.bookings.show', $booking->id) }}" class="btn btn-sm btn-outline-primary" title="Lihat Detail">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>

                                        @if($booking->status === 'pending_payment')
                                            <a href="{{ route('customer.bookings.show', $booking->id) }}" class="btn btn-sm btn-warning" title="Upload Bukti Bayar">
                                                <i class="fas fa-upload"></i> Bayar
                                            </a>
                                        @endif

                                        @if(in_array($booking->status, ['dp_paid', 'fully_paid']) && $booking->service->type === 'boarding')
                                            <a href="{{ route('customer.boardings.logs', $booking->id) }}" class="btn btn-sm btn-success" title="Pantau Kucing">
                                                <i class="fas fa-paw"></i> Pantau
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 border-0">
                                    <div class="my-3">
                                        <i class="fas fa-receipt fa-4x text-muted mb-3"></i>
                                        <h5 class="text-secondary fw-bold">Belum Ada Riwayat Transaksi</h5>
                                        <p class="text-muted small">Semua riwayat pemesanan perawatan atau penitipan kucingmu akan tertera di sini.</p>
                                        <a href="{{ route('customer.bookings.create') }}" class="btn btn-primary btn-sm mt-2">Mulai Booking Sekarang</a>
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
@endsection