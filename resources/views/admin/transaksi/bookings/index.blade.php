@extends("admin.layouts.app")

@section("content_title", "Daftar Booking")

@section("content")
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Daftar Transaksi Booking</h4>

        <div class="d-flex justify-content-end mb-2">
            {{-- Tombol untuk menuju form Kasir / Walk-in --}}
            <a href="{{ route('admin.transaksi.bookings.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Tambah Booking (Walk-in)
            </a>
        </div>
    </div>

    <div class="card-body">
        <x-admin.alert :error="$errors->any()" />

        <div class="table-responsive">
            <table class="table table-sm" id="datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Booking</th>
                        <th>Pelanggan</th>
                        <th>Kucing</th>
                        <th>Layanan</th>
                        <th>Tgl Mulai</th>
                        <th>Status</th>
                        <th>Total Harga</th>
                        <th>Opsi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($bookings as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>

                            <td class="fw-bold">
                                {{ $item->booking_code }}
                                @if($item->is_walk_in)
                                    <br><span class="badge bg-secondary" style="font-size: 0.7em;">Walk-in</span>
                                @endif
                            </td>

                            <td>{{ $item->user->name ?? 'User Dihapus' }}</td>
                            
                            <td>{{ $item->cat->name ?? 'Kucing Dihapus' }}</td>

                            <td>{{ $item->service->name ?? 'Layanan Dihapus' }}</td>

                            <td>{{ \Carbon\Carbon::parse($item->start_date)->format('d M Y') }}</td>

                            <td>
                                @php
                                    $statusColor = match($item->status) {
                                        'pending_payment' => 'bg-light-warning text-warning',
                                        'waiting_confirmation' => 'bg-light-info text-info',
                                        'dp_paid' => 'bg-light-primary text-primary',
                                        'fully_paid' => 'bg-light-success text-success',
                                        'completed' => 'bg-success text-white',
                                        'cancelled' => 'bg-danger text-white',
                                        default => 'bg-light-secondary text-secondary'
                                    };
                                    
                                    $statusText = match($item->status) {
                                        'pending_payment' => 'Menunggu Pembayaran',
                                        'waiting_confirmation' => 'Menunggu Konfirmasi',
                                        'dp_paid' => 'DP Dibayar',
                                        'fully_paid' => 'Lunas',
                                        'completed' => 'Selesai',
                                        'cancelled' => 'Dibatalkan',
                                        default => $item->status
                                    };
                                @endphp
                                <span class="badge {{ $statusColor }}">
                                    {{ $statusText }}
                                </span>
                            </td>

                            <td>
                                Rp {{ number_format($item->total_price, 0, ',', '.') }}
                            </td>

                            <td>
                                <div class="d-flex align-items-center">
                                    {{-- Tombol Detail / Show --}}
                                    <a href="{{ route('admin.transaksi.bookings.show', $item->id) }}"
                                       class="btn btn-sm btn-info mx-1 text-light"
                                       title="Lihat Detail">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection