@extends("admin.layouts.app")

@section("content_title", "Laporan Pendapatan")

@section("content")
<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card bg-light-primary">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-7">
                        <form action="{{ route('admin.laporan.keuangan') }}" method="GET" class="d-flex align-items-center gap-2">
                            <div>
                                <label for="start_date" class="form-label mb-0 small text-muted">Dari Tanggal</label>
                                <input type="date" name="start_date" id="start_date" class="form-control form-control-sm" value="{{ $startDate }}" required>
                            </div>
                            <div>
                                <label for="end_date" class="form-label mb-0 small text-muted">Sampai Tanggal</label>
                                <input type="date" name="end_date" id="end_date" class="form-control form-control-sm" value="{{ $endDate }}" required>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fas fa-filter"></i> Filter
                                </button>
                                <a href="{{ route('admin.laporan.keuangan') }}" class="btn btn-outline-secondary btn-sm">
                                    Reset
                                </a>
                            </div>
                        </form>
                    </div>
                    
                    <div class="col-md-5 text-end mt-3 mt-md-0 border-start">
                        <p class="text-muted mb-1 small">Total Pendapatan (Periode Dipilih)</p>
                        <h2 class=" mb-0 fw-bold">
                            Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Rincian Transaksi Selesai</h4>
                <button onclick="window.print()" class="btn btn-sm btn-success">
                    <i class="fas fa-print me-1"></i> Cetak Laporan
                </button>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="datatable">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Kode Booking</th>
                                <th>Pelanggan</th>
                                <th>Layanan</th>
                                <th>Status</th>
                                <th class="text-end">Nominal</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            {{-- Gunakan foreach biasa, hindari @empty agar DataTables tidak error saat data kosong --}}
                            @foreach ($bookings as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    
                                    <td class="text-nowrap">
                                        {{ \Carbon\Carbon::parse($item->start_date)->format('d M Y') }}
                                    </td>

                                    <td class="fw-bold">
                                        <a href="{{ route('admin.transaksi.bookings.show', $item->id) }}" class="text-decoration-none">
                                            {{ $item->booking_code }}
                                        </a>
                                    </td>

                                    <td>{{ $item->user->name ?? 'Pelanggan Dihapus' }}</td>

                                    <td>
                                        {{ $item->service->name ?? '-' }}
                                        <span class="badge bg-secondary ms-1" style="font-size: 0.65em;">
                                            {{ ucfirst($item->service->type ?? '') }}
                                        </span>
                                    </td>

                                    <td>
                                        @if($item->status == 'completed')
                                            <span class="badge bg-success">Selesai</span>
                                        @elseif($item->status == 'fully_paid')
                                            <span class="badge bg-primary">Lunas</span>
                                        @endif
                                    </td>

                                    <td class="text-end fw-bold text-success">
                                        Rp {{ number_format($item->total_price, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        
                        <tfoot class="table-light fw-bold">
                            <tr>
                                {{-- Buat 5 tag th kosong (tanpa tulisan) --}}
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                
                                {{-- Tag ke-6 untuk label --}}
                                <th class="text-end text-uppercase">Total Keseluruhan:</th>
                                
                                {{-- Tag ke-7 untuk nominal --}}
                                <th class="text-end text-primary fs-6">
                                    Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        .pc-sidebar, .pc-header, form, button, a.btn {
            display: none !important;
        }
        .card, .card * {
            visibility: visible;
            border: none !important;
            box-shadow: none !important;
        }
        .card {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
        .badge {
            border: 1px solid #000;
            color: #000 !important;
            background: transparent !important;
        }
    }


    @media (max-width: 768px) {

        .card-header{
            flex-direction: column;
            align-items: flex-start !important;
            gap: 10px;
        }

        .card-header .btn{
            width: 100%;
        }

        form.d-flex{
            flex-direction: column;
            align-items: stretch !important;
        }

        form.d-flex > div{
            width: 100%;
        }

        form.d-flex .mt-4{
            margin-top: 10px !important;

            display: flex;
            gap: 10px;
        }

        form.d-flex .btn{
            width: 100%;
        }

        .border-start{
            border-left: none !important;
            border-top: 1px solid #dee2e6;
            padding-top: 15px;
        }

        .table-responsive{
            overflow-x: auto;
        }

        table{
            min-width: 850px;
        }

        td,
        th{
            white-space: nowrap;
            vertical-align: middle;
        }

        .card-title{
            font-size: 1rem;
        }

        h2{
            font-size: 1.5rem;
        }
    }
</style>
@endpush