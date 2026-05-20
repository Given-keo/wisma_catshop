@extends('customer.layouts.app')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Pantau Buku Harian {{ $booking->cat->name ?? 'Kucing' }}</h2>
        <a href="{{ route('customer.bookings.index') }}" class="btn btn-secondary btn-sm shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card shadow border-0 text-center p-3">
                <div class="card-body">
                    <img src="{{ $booking->cat->photo ? asset('storage/' . $booking->cat->photo) : 'https://placehold.co/150?text=Meow' }}" 
                         class="rounded-circle mb-3 border shadow-sm" style="width: 120px; height: 120px; object-fit: cover;">
                <h5 class="fw-bold text-dark mb-1">{{ $booking->cat->name }}</h5>
                    <p class="text-muted small mb-3">{{ $booking->cat->breed ?? 'Ras Campuran' }} ({{ $booking->cat->gender }})</p>
                    
                    <hr>
                    
                    <div class="text-start bg-light p-3 rounded small">
                        <div class="mb-2"><strong>Kode Booking:</strong><br><span class="text-primary fw-bold">{{ $booking->booking_code }}</span></div>
                        <div class="mb-2"><strong>Tanggal Masuk:</strong><br>{{ \Carbon\Carbon::parse($booking->start_date)->format('d M Y') }}</div>
                        <div><strong>Rencana Keluar:</strong><br>{{ $booking->end_date ? \Carbon\Carbon::parse($booking->end_date)->format('d M Y') : '-' }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8 mb-4">
            <div class="card shadow border-0">
                <div class="card-header py-3 bg-white">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-history me-1"></i> Aktivitas & Perkembangan Harian</h6>
                </div>
                <div class="card-body">
                    
                    @forelse($logs as $log)
                        <div class="border-start border-primary border-3 ps-4 pb-4 position-relative mb-2">
                            <div class="position-absolute bg-primary text-white rounded-circle text-center d-flex align-items-center justify-content-center" 
                                 style="width: 32px; height: 32px; left: -18px; top: 0;">
                                <i class="fas fa-calendar-day small"></i>
                            </div>
                            
                            <div class="card bg-light border-0 shadow-sm ms-2">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                                        <h6 class="fw-bold text-primary mb-0">
                                            📅 {{ \Carbon\Carbon::parse($log->log_date)->format('l, d F Y') }}
                                        </h6>
                                    </div>
                                    
                                    <div class="row g-3">
                                        <div class="col-sm-6">
                                            <small class="text-muted d-block"><i class="fas fa-utensils me-1 text-warning"></i> Kondisi Makan:</small>
                                            <span class="fw-bold text-dark">{{ $log->eating_condition }}</span>
                                        </div>
                                        <div class="col-sm-6">
                                            <small class="text-muted d-block"><i class="fas fa-running me-1 text-info"></i> Aktivitas Kucing:</small>
                                            <span class="fw-bold text-dark">{{ $log->activity }}</span>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <small class="text-muted d-block"><i class="fas fa-heartbeat me-1 text-danger"></i> Catatan Kesehatan / Catatan Tambahan:</small>
                                            <p class="mb-0 bg-white p-2 rounded border mt-1 small text-secondary">
                                                {{ $log->health_notes ?? 'Kucing dalam kondisi sehat, ceria, dan tidak ada keluhan khusus.' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5 text-muted">
                            <i class="fas fa-clipboard-list fa-3x mb-3"></i>
                            <h5>Belum Ada Log Hari Ini</h5>
                            <p class="small">Admin Wisma CatShop belum memperbarui catatan aktivitas atau kondisi kucing untuk hari ini. Silakan cek kembali nanti ya!</p>
                        </div>
                    @endforelse

                </div>
            </div>
        </div>
    </div>

</div>
@endsection