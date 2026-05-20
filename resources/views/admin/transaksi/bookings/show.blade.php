@extends("admin.layouts.app")

@section("content_title", "Detail Booking")

@section("content")
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Informasi Booking: {{ $booking->booking_code }}</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th width="30%">Nama Pelanggan</th>
                        <td>{{ $booking->user->name ?? '-' }} ({{ $booking->user->whatsapp ?? '-' }})</td>
                    </tr>
                    <tr>
                        <th>Nama Kucing</th>
                        <td>{{ $booking->cat->name ?? '-' }} ({{ $booking->cat->breed ?? 'Ras tidak diketahui' }})</td>
                    </tr>
                    <tr>
                        <th>Layanan</th>
                        <td>
                            {{ $booking->service->name ?? '-' }} 
                            <span class="badge bg-secondary ms-2">{{ ucfirst($booking->service->type ?? '') }}</span>
                        </td>
                    </tr>
                    <tr>
                        <th>Tanggal Pelaksanaan</th>
                        <td>
                            {{ \Carbon\Carbon::parse($booking->start_date)->format('d M Y') }}
                            @if($booking->end_date)
                                s/d {{ \Carbon\Carbon::parse($booking->end_date)->format('d M Y') }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Barang Bawaan</th>
                        <td>{{ $booking->brought_items ?? 'Tidak ada catatan' }}</td>
                    </tr>
                    <tr>
                        <th>Tipe Booking</th>
                        <td>
                            @if($booking->is_walk_in)
                                <span class="badge bg-secondary">Walk-in (Datang Langsung)</span>
                            @else
                                <span class="badge bg-primary">Online Booking</span>
                            @endif
                        </td>
                    </tr>
                </table>

                <h5 class="mt-4 border-bottom pb-2">Informasi Pembayaran</h5>
                <table class="table table-bordered">
                    <tr>
                        <th width="30%">Total Harga</th>
                        <td class="fw-bold">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>DP Dibayar</th>
                        <td>Rp {{ number_format($booking->down_payment, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Sisa Tagihan</th>
                        <td class="text-danger fw-bold">
                            Rp {{ number_format($booking->total_price - $booking->down_payment, 0, ',', '.') }}
                        </td>
                    </tr>
                    <tr>
                        <th>Bukti Transfer</th>
                        <td>
                            @if($booking->payment_proof)
                                {{-- Pastikan storage link sudah dikonfigurasi jika menyimpan di local storage --}}
                                <a href="{{ asset('storage/' . $booking->payment_proof) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-image me-1"></i> Lihat Bukti Transfer
                                </a>
                            @else
                                <span class="text-muted">Belum ada bukti transfer.</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
            <div class="card-footer">
                <a href="{{ route('admin.transaksi.bookings.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-light">
                <h4 class="card-title">Update Status</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.transaksi.bookings.update-status', $booking->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="status" class="form-label">Status Saat Ini</label>
                        <select name="status" id="status" class="form-select">
                            <option value="pending_payment" {{ $booking->status == 'pending_payment' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                            <option value="waiting_confirmation" {{ $booking->status == 'waiting_confirmation' ? 'selected' : '' }}>Menunggu Konfirmasi Bukti</option>
                            <option value="dp_paid" {{ $booking->status == 'dp_paid' ? 'selected' : '' }}>DP Dibayar</option>
                            <option value="fully_paid" {{ $booking->status == 'fully_paid' ? 'selected' : '' }}>Lunas</option>
                            <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                            <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success w-100">
                        <i class="fas fa-save me-1"></i> Simpan Status
                    </button>
                </form>

                @if($booking->status == 'completed' && !$booking->is_reward_claimed)
                    <div class="alert alert-info mt-3" style="font-size: 0.85em;">
                        <i class="fas fa-info-circle me-1"></i> Status 'Selesai' akan otomatis menambahkan poin loyalitas ke pelanggan.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection