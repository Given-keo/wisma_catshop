@extends('customer.layouts.app') 

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">📄 Detail Transaksi #{{ $booking->booking_code }}</h2>
        <a href="{{ route('customer.bookings.index') }}" class="btn btn-secondary btn-sm shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali ke Riwayat
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-7 mb-4">
            <div class="card shadow border-0 h-100">
                <div class="card-header py-3 bg-white">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-info-circle me-1"></i> Informasi Lengkap</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless table-striped align-middle">
                        <tr>
                            <th width="35%">Status Pesanan</th>
                            <td>
                                @switch($booking->status)
                                    @case('pending_payment')
                                        <span class="badge bg-warning text-dark p-2"><i class="fas fa-wallet me-1"></i> Menunggu Pembayaran</span>
                                        @break
                                    @case('waiting_confirmation')
                                        <span class="badge bg-info text-white p-2"><i class="fas fa-clock me-1"></i> Menunggu Konfirmasi Admin</span>
                                        @break
                                    @case('dp_paid')
                                        <span class="badge bg-primary text-white p-2"><i class="fas fa-check-circle me-1"></i> DP Dibayar</span>
                                        @break
                                    @case('fully_paid')
                                        <span class="badge bg-success text-white p-2"><i class="fas fa-check-double me-1"></i> Lunas</span>
                                        @break
                                    @case('completed')
                                        <span class="badge bg-secondary text-white p-2"><i class="fas fa-flag-checkered me-1"></i> Selesai</span>
                                        @break
                                    @case('cancelled')
                                        <span class="badge bg-danger text-white p-2"><i class="fas fa-times-circle me-1"></i> Dibatalkan</span>
                                        @break
                                @endswitch
                            </td>
                        </tr>
                        <tr>
                            <th>Jenis Layanan</th>
                            <td class="fw-bold text-dark">{{ $booking->service->name ?? 'Layanan' }} <span class="badge bg-light text-muted border text-capitalize">{{ $booking->service->type ?? '-' }}</span></td>
                        </tr>
                        <tr>
                            <th>Kucing Kesayangan</th>
                            <td>🐾 {{ $booking->cat->name ?? 'Kucing Terhapus' }} <small class="text-muted">({{ $booking->cat->breed ?? '-' }})</small></td>
                        </tr>
                        <tr>
                            <th>Tanggal Masuk / Mulai</th>
                            <td><i class="far fa-calendar-alt me-1 text-primary"></i> {{ \Carbon\Carbon::parse($booking->start_date)->format('d F Y') }}</td>
                        </tr>
                        @if($booking->end_date)
                            <tr>
                                <th>Tanggal Keluar / Selesai</th>
                                <td><i class="far fa-calendar-alt me-1 text-danger"></i> {{ \Carbon\Carbon::parse($booking->end_date)->format('d F Y') }}</td>
                            </tr>
                        @endif
                        <tr>
                            <th>Barang Bawaan / Catatan</th>
                            <td><span class="text-muted">{{ $booking->brought_items ?? 'Tidak ada barang bawaan khusus.' }}</span></td>
                        </tr>
                        <tr class="table-light border-top">
                            <th class="fs-5 text-dark">Total Biaya</th>
                            <td class="fs-4 fw-bold text-success">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                        </tr>
                    </table>

                    @if(in_array($booking->status, ['dp_paid', 'fully_paid']) && $booking->service->type === 'boarding')
                        <div class="mt-4">
                            <a href="{{ route('customer.boardings.logs', $booking->id) }}" class="btn btn-success w-100 py-2">
                                <i class="fas fa-paw me-2"></i> Kucing Sedang Dititipkan! Pantau Log Harian di Sini
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-5 mb-4">
            <div class="card shadow border-0 h-100">
                <div class="card-header py-3 bg-white">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-qrcode me-1"></i> Pembayaran QRIS</h6>
                </div>
                <div class="card-body text-center d-flex flex-column justify-content-between">
                    
                    {{--  STATUS PENDING (BELUM BAYAR) --}}
                    @if($booking->status === 'pending_payment')
                        <div>
                            <p class="text-muted small mb-3">Silakan scan kode QRIS di bawah ini melalui aplikasi M-Banking atau E-Wallet Anda (Gopay, OVO, Dana, LinkAja, dll.) sebesar nilai total biaya.</p>
                            
                            <div class="p-3 bg-white border rounded shadow-inner d-inline-block mb-3">
                                <img src="{{ asset('admin_template\assets\images\qris.jpeg') }}" alt="QRIS Wisma CatShop" class="img-fluid" style="max-width: 240px;">
                            </div>
                            <h5 class="fw-bold text-dark mb-1">WISMA CATSHOP</h5>
                            <small class="text-muted d-block mb-3">NMID: ID1024327376850</small>
                        </div>

                        <div class="bg-light p-3 rounded border text-start mt-auto">
                            <form action="{{ route('customer.bookings.upload_payment', $booking->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <label for="payment_proof" class="form-label fw-bold small text-secondary">Upload Bukti Transfer / Transaksi <span class="text-danger">*</span></label>
                                <input class="form-control form-control-sm @error('payment_proof') is-invalid @enderror" type="file" id="payment_proof" name="payment_proof" accept="image/*" required>
                                @error('payment_proof')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <button type="submit" class="btn btn-warning btn-sm w-100 mt-3 fw-bold">
                                    <i class="fas fa-cloud-upload-alt me-1"></i> Kirim Bukti Pembayaran
                                </button>
                            </form>
                        </div>

                    {{-- SUDAH UPLOAD, MENUNGGU VERIFIKASI ADMIN --}}
                    @elseif($booking->status === 'waiting_confirmation')
                        <div class="my-auto py-4">
                            <div class="text-info fs-1 mb-3">
                                <i class="fas fa-hourglass-half fa-spin"></i>
                            </div>
                            <h5 class="fw-bold text-dark">Bukti Pembayaran Terkirim!</h5>
                            <p class="text-muted small px-3 mt-2">Terima kasih, admin kami sedang melakukan pengecekan rekening. Status pesanan Anda akan diperbarui dalam waktu berkala.</p>
                            
                            @if($booking->payment_proof)
                                <hr>
                                <small class="text-muted d-block mb-2">Bukti yang Anda unggah:</small>
                                <a href="{{ asset('storage/' . $booking->payment_proof) }}" target="_blank" class="btn btn-xs btn-outline-secondary">
                                    <i class="fas fa-image me-1"></i> Lihat Gambar Bukti
                                </a>
                            @endif
                        </div>

                    {{-- STATUS TRANSAKSI SUDAH DIVERIFIKASI AMAN / LUNAS / SELESAI --}}
                    @elseif(in_array($booking->status, ['dp_paid', 'fully_paid', 'completed']))
                        <div class="my-auto py-5 text-success">
                            <div class="fs-1 mb-3">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <h5 class="fw-bold text-dark">Pembayaran Terverifikasi</h5>
                            <p class="text-muted small px-3 mt-2">Transaksi ini dinyatakan sah dan telah dikonfirmasi oleh pihak manajemen Wisma CatShop.</p>
                        </div>

                    {{-- DIBATALKAN --}}
                    @else
                        <div class="my-auto py-5 text-danger">
                            <div class="fs-1 mb-3">
                                <i class="fas fa-ban"></i>
                            </div>
                            <h5 class="fw-bold text-dark">Transaksi Dibatalkan</h5>
                            <p class="text-muted small px-3 mt-2">Pemesanan ini telah hangus atau dibatalkan. Silakan hubungi admin via WhatsApp jika terjadi kekeliruan.</p>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

</div>
@endsection