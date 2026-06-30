@extends("admin.layouts.app")

@section("content_title", "Riwayat Laporan Harian")

@section("content")
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Informasi Titipan</h4>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <span class="d-block text-muted" style="font-size: 0.85em;">Kode Booking</span>
                    <span class="fw-bold text-primary">{{ $booking->booking_code }}</span>
                </div>
                <div class="mb-3">
                    <span class="d-block text-muted" style="font-size: 0.85em;">Nama Kucing</span>
                    <span class="fw-bold">{{ $booking->cat->name ?? '-' }}</span> 
                    <small>({{ $booking->cat->breed ?? 'Ras tidak diketahui' }})</small>
                </div>
                <div class="mb-3">
                    <span class="d-block text-muted" style="font-size: 0.85em;">Pemilik</span>
                    <span class="fw-bold">{{ $booking->user->name ?? '-' }}</span>
                </div>
                <div class="mb-3">
                    <span class="d-block text-muted" style="font-size: 0.85em;">Layanan</span>
                    <span class="badge bg-secondary">{{ $booking->service->name ?? '-' }}</span>
                </div>
                <div class="mb-3">
                    <span class="d-block text-muted" style="font-size: 0.85em;">Periode Menginap</span>
                    <span class="fw-bold">
                        {{ \Carbon\Carbon::parse($booking->start_date)->format('d M Y') }}
                        s/d 
                        {{ $booking->end_date ? \Carbon\Carbon::parse($booking->end_date)->format('d M Y') : '?' }}
                    </span>
                </div>
                <hr>
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.transaksi.boarding_logs.create', $booking->id) }}" class="btn btn-success">
                        <i class="fas fa-edit me-1"></i> Tambah Log Hari Ini
                    </a>
                    <a href="{{ route('admin.transaksi.boarding_logs.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Riwayat Kondisi Harian</h4>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Tanggal</th>
                                <th>Kondisi Makan</th>
                                <th>Aktivitas & Mood</th>
                                <th>Catatan Kesehatan</th>
                                <th>Foto</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($logs as $log)
                                <tr>
                                    <td class="fw-bold text-nowrap">
                                        {{ \Carbon\Carbon::parse($log->log_date)->format('d M Y') }}
                                    </td>
                                    
                                    <td>
                                        @php
                                            $makanColor = match($log->eating_condition) {
                                                'Sangat Lahap' => 'bg-success',
                                                'Normal / Habis' => 'bg-info',
                                                'Sedikit / Bersisa' => 'bg-warning text-dark',
                                                'Tidak Mau Makan' => 'bg-danger',
                                                default => 'bg-secondary'
                                            };
                                        @endphp
                                        <span class="badge {{ $makanColor }}">
                                            {{ $log->eating_condition }}
                                        </span>
                                    </td>

                                    <td>
                                        @php
                                            $aktifColor = match($log->activity) {
                                                'Sangat Aktif & Bermain' => 'bg-success',
                                                'Aktif Normal' => 'bg-info',
                                                'Banyak Tidur / Santai' => 'bg-secondary',
                                                'Terlihat Takut / Agresif' => 'bg-warning text-dark',
                                                'Lesu' => 'bg-danger',
                                                default => 'bg-secondary'
                                            };
                                        @endphp
                                        <span class="badge {{ $aktifColor }}">
                                            {{ $log->activity }}
                                        </span>
                                    </td>

                                    <td>
                                        @if($log->health_notes)
                                            <span style="font-size: 0.9em;">{{ $log->health_notes }}</span>
                                        @else
                                            <span class="text-muted fst-italic" style="font-size: 0.85em;">Tidak ada catatan</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($log->photo_path)
                                            <a href="{{ asset('storage/' . $log->photo_path) }}" target="_blank">
                                                <img src="{{ asset('storage/' . $log->photo_path) }}" 
                                                     alt="Foto Kucing" 
                                                     style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px;"
                                                     class="shadow-sm">
                                            </a>
                                        @else
                                            <span class="text-muted fst-italic" style="font-size: 0.85em;">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="fas fa-clipboard-list fs-2 mb-3 d-block"></i>
                                            Belum ada laporan harian yang dicatat untuk kucing ini.
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