@extends("admin.layouts.app")

@section("content_title", "Laporan Layanan Terpopuler")

@section("content")
<div class="d-none d-print-block text-center mb-3">
    <h3 class="fw-bold mb-1">LAPORAN LAYANAN TERPOPULER</h3>
    <p class="text-muted mb-0">Periode: {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} s/d {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}</p>
    <hr style="border-top: 2px solid #000;">
</div>
<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="row g-3 align-items-center">
                    <div class="col-md-7">
                        <form action="{{ route('admin.laporan.layanan') }}" method="GET" class="row g-2">
                            <div class="col-6 col-sm-4">
                                <label for="start_date" class="form-label mb-0 small text-muted">Dari Tanggal</label>
                                <input type="date" name="start_date" id="start_date" class="form-control form-control-sm" value="{{ $startDate }}" required>
                            </div>
                            <div class="col-6 col-sm-4">
                                <label for="end_date" class="form-label mb-0 small text-muted">Sampai Tanggal</label>
                                <input type="date" name="end_date" id="end_date" class="form-control form-control-sm" value="{{ $endDate }}" required>
                            </div>
                            <div class="col-12 col-sm-4 d-flex gap-2 align-items-end">
                                <button type="submit" class="btn btn-primary btn-sm flex-fill">
                                    <i class="fas fa-filter"></i> Filter
                                </button>
                                <a href="{{ route('admin.laporan.layanan') }}" class="btn btn-outline-secondary btn-sm flex-fill">
                                    Reset
                                </a>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-5 text-md-end mt-3 mt-md-0 border-md-start ps-md-4">
                        <p class="text-muted mb-1 small">Total Layanan Dipesan (Periode Dipilih)</p>
                        <h2 class="mb-0 fw-bold text-info">
                            {{ $popularServices->sum('total_pesanan') }}x
                            <small class="fs-6 text-muted fw-normal">pesanan</small>
                        </h2>
                        <small class="text-muted">
                            Estimasi Pendapatan: Rp {{ number_format($popularServices->sum('total_pendapatan'), 0, ',', '.') }}
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                <h4 class="card-title mb-0">Peringkat Layanan Terlaris</h4>
                <button onclick="window.print()" class="btn btn-sm btn-success">
                    <i class="fas fa-print me-1"></i> Cetak Laporan
                </button>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="table-layanan">
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
                                            @ Rp {{ number_format($item->price, 0, ',', '.') }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="text-muted">{{ ucfirst($item->type) }}</span>
                                    </td>

                                    <td class="text-center fw-bold fs-6">
                                        {{ $item->total_pesanan }}x
                                    </td>

                                    <td class="text-end fw-bold text-success">
                                        Rp {{ number_format($item->total_pendapatan ?? 0, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">
                                        <i class="fas fa-inbox fs-3 mb-2 d-block"></i>
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
        @page {
            margin: 15mm 10mm;
        }
        body {
            background: #fff !important;
        }
        .pc-sidebar, .pc-header, .loader-bg, form, .btn,
        .card-header .btn, .dataTables_length, .dataTables_filter,
        .dataTables_info, .dataTables_paginate, .dt-buttons {
            display: none !important;
        }
        .pc-container {
            margin-left: 0 !important;
            padding: 0 !important;
            max-width: 100% !important;
        }
        .pc-content {
            padding: 0 !important;
            margin: 0 !important;
        }
        .row {
            margin: 0 !important;
        }
        .row > .col-md-12 {
            padding: 0 !important;
        }
        .card {
            border: none !important;
            box-shadow: none !important;
            margin-bottom: 0 !important;
            page-break-inside: avoid;
        }
        .card-body {
            padding: 0 !important;
        }
        .card-header {
            border-bottom: 2px solid #000 !important;
            padding: 10px 0 !important;
            margin-bottom: 10px !important;
            background: #fff !important;
        }
        .card-header h4 {
            font-size: 16pt !important;
            font-weight: bold !important;
            color: #000 !important;
        }
        .badge {
            border: 1px solid #000;
            color: #000 !important;
            background: transparent !important;
            padding: 2px 6px !important;
            font-size: 8pt !important;
        }
        .text-success, .text-primary, .text-info {
            color: #000 !important;
        }
        .table-responsive {
            overflow: visible !important;
            padding: 0 !important;
        }
        table {
            width: 100% !important;
            font-size: 9pt !important;
            border-collapse: collapse !important;
        }
        table thead th {
            border-bottom: 2px solid #000 !important;
            background: #f5f5f5 !important;
            color: #000 !important;
            padding: 6px 8px !important;
        }
        table tbody td {
            padding: 5px 8px !important;
            border-bottom: 1px solid #ddd !important;
        }
        table tfoot td {
            border-top: 2px solid #000 !important;
            padding: 6px 8px !important;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background: #fafafa !important;
        }
        .mb-4, .mb-3 {
            margin-bottom: 0 !important;
        }
        .row.g-3 {
            margin: 0 !important;
        }
        .row.g-3 > [class*="col-"] {
            padding: 0 !important;
        }
        .pc-container > .pc-content > .row > .col-md-12:first-child .card {
            border-bottom: 2px solid #ddd !important;
            padding-bottom: 10px !important;
            margin-bottom: 15px !important;
        }
        a {
            color: #000 !important;
            text-decoration: none !important;
        }
        .fw-bold {
            font-weight: bold !important;
        }
        h2 {
            font-size: 14pt !important;
        }
        .text-muted {
            color: #666 !important;
        }
        small, .small {
            font-size: 8pt !important;
        }
        .border-md-start {
            border-left: none !important;
        }
        td, th {
            white-space: nowrap;
            vertical-align: middle;
        }
    }

    @media (max-width: 768px) {
        .table-responsive {
            overflow-x: auto;
        }
        table {
            min-width: 700px;
        }
        .border-md-start {
            border-left: none !important;
            border-top: 1px solid #dee2e6;
            padding-top: 1rem;
        }
        td, th {
            white-space: nowrap;
            vertical-align: middle;
        }
    }
</style>
@endpush

@push('js')
<script>
    $(document).ready(function () {
        @if($popularServices->count() > 0)
        $('#table-layanan').DataTable({
            ordering: false,
            paging: false,
            info: false,
            searching: false,
            lengthChange: false
        });
        @endif
    });
</script>
@endpush