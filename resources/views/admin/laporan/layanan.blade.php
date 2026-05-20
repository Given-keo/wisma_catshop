@extends("admin.layouts.app")

@section("content_title", "Laporan Layanan Terpopuler")

@section("content")
<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card bg-light-info ">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <form action="{{ route('admin.laporan.layanan') }}" method="GET" class="d-flex align-items-center gap-2">
                            <div>
                                <label for="start_date" class="form-label mb-0 small text-muted">Dari Tanggal</label>
                                <input type="date" name="start_date" id="start_date" class="form-control form-control-sm" value="{{ $startDate }}" required>
                            </div>
                            <div>
                                <label for="end_date" class="form-label mb-0 small text-muted">Sampai Tanggal</label>
                                <input type="date" name="end_date" id="end_date" class="form-control form-control-sm" value="{{ $endDate }}" required>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-info btn-sm text-white">
                                    <i class="fas fa-filter"></i> Filter
                                </button>
                                <a href="{{ route('admin.laporan.layanan') }}" class="btn btn-outline-secondary btn-sm">
                                    Reset
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Peringkat Layanan Terlaris</h4>
                <button onclick="window.print()" class="btn btn-sm btn-success">
                    <i class="fas fa-print me-1"></i> Cetak Laporan
                </button>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="datatable">
                        <thead class="table-light">
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th>Nama Layanan</th>
                                <th>Kategori</th>
                                <th class="text-center">Total Dipesan</th>
                                <th class="text-end">Estimasi Pendapatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($popularServices as $index => $item)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    
                                    <td class="fw-bold">
                                        {{ $item->name }}
                                        <br>
                                        <span class="text-muted fw-normal" style="font-size: 0.85em;">
                                            Harga Dasar: Rp {{ number_format($item->price, 0, ',', '.') }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="badge {{ $item->type == 'grooming' ? 'bg-primary' : 'bg-success' }}">
                                            {{ ucfirst($item->type) }}
                                        </span>
                                    </td>

                                    <td class="text-center">
                                        <span class="badge bg-warning text-dark fs-6 px-3 py-2">
                                            {{ $item->total_pesanan }}x
                                        </span>
                                    </td>

                                    <td class="text-end fw-bold text-success">
                                        Rp {{ number_format($item->total_pendapatan ?? 0, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">
                                        Tidak ada data layanan yang dipesan pada periode tanggal ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        @if($popularServices->count() > 0)
                            <tfoot class="table-light fw-bold">
                                <tr>
                                    <td colspan="3" class="text-end text-uppercase">Total Keseluruhan:</td>
                                    <td class="text-center fs-6 text-dark">
                                        {{ $popularServices->sum('total_pesanan') }}x
                                    </td>
                                    <td class="text-end text-primary fs-6">
                                        Rp {{ number_format($popularServices->sum('total_pendapatan'), 0, ',', '.') }}
                                    </td>
                                </tr>
                            </tfoot>
                        @endif
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

        .table-responsive{
            overflow-x: auto;
        }

        table{
            min-width: 700px;
        }

        .card-title{
            font-size: 1rem;
        }

        td, th{
            white-space: nowrap;
            vertical-align: middle;
        }
    }
</style>
@endpush