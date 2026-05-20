@extends("admin.layouts.app")

@section("content_title", "Daftar Kucing Menginap")

@section("content")
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Kucing yang Sedang Dititipkan (Boarding)</h4>
        <p class="text-muted mb-0">Halaman ini hanya menampilkan booking dengan layanan penitipan yang berstatus DP Dibayar atau Lunas.</p>
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
                        <th>Tgl Masuk</th>
                        <th>Tgl Keluar</th>
                        <th>Opsi Log Harian</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($bookings as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>

                            <td class="fw-bold text-primary">
                                {{ $item->booking_code }}
                            </td>

                            <td>{{ $item->user->name ?? '-' }}</td>
                            
                            <td>
                                {{ $item->cat->name ?? '-' }}
                                <br>
                                <small class="text-muted">{{ $item->cat->breed ?? '' }}</small>
                            </td>

                            <td>{{ \Carbon\Carbon::parse($item->start_date)->format('d M Y') }}</td>
                            
                            <td>
                                @if($item->end_date)
                                    {{ \Carbon\Carbon::parse($item->end_date)->format('d M Y') }}
                                @else
                                    <span class="text-muted">Belum diset</span>
                                @endif
                            </td>

                            <td>
                                <div class="d-flex align-items-center">
                                    {{-- Tombol Tambah Log Baru --}}
                                    <a href="{{ route('admin.transaksi.boarding_logs.create', $item->id) }}"
                                    class="btn btn-sm btn-success mx-1 text-light"
                                    title="Isi Laporan Hari Ini">
                                        <i class="fas fa-edit"></i> Isi Log
                                    </a>

                                    {{-- Tombol Lihat Riwayat Log --}}
                                    <a href="{{ route('admin.transaksi.boarding_logs.history', $item->id) }}"
                                    class="btn btn-sm btn-info mx-1 text-light"
                                    title="Lihat Riwayat Laporan">
                                        <i class="fas fa-history"></i> Riwayat
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