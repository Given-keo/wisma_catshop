@extends("admin.layouts.app")

@section("content_title", "Laporan Pendapatan")

@section("content")
<div class="d-none d-print-block text-center mb-3">
    <h3 class="fw-bold mb-1">LAPORAN PENDAPATAN</h3>
    <p class="text-muted mb-0">Periode: {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} s/d {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}</p>
    <hr style="border-top: 2px solid #000;">
</div>
<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="row g-3 align-items-center">
                    <div class="col-md-7">
                        <form action="{{ route('admin.laporan.keuangan') }}" method="GET" class="row g-2">
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
                                <a href="{{ route('admin.laporan.keuangan') }}" class="btn btn-outline-secondary btn-sm flex-fill">
                                    Reset
                                </a>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-5 text-md-end mt-3 mt-md-0 border-md-start ps-md-4">
                        <p class="text-muted mb-1 small">Total Pendapatan (Periode Dipilih)</p>
                        <h2 class="mb-0 fw-bold text-success">
                            Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                <h4 class="card-title mb-0">Rincian Transaksi Selesai</h4>
                <button onclick="window.print()" class="btn btn-sm btn-success">
                    <i class="fas fa-print me-1"></i> Cetak Laporan
                </button>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="table-laporan">
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
                            @forelse ($bookings as $index => $item)
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
                                        <small class="text-muted">({{ ucfirst($item->service->type ?? '') }})</small>
                                    </td>

                                    <td>
                                        @if($item->status == 'completed')
                                            <span class="text-success fw-semibold">Selesai</span>
                                        @elseif($item->status == 'fully_paid')
                                            <span class="text-primary fw-semibold">Lunas</span>
                                        @endif
                                    </td>

                                    <td class="text-end fw-bold text-success">
                                        Rp {{ number_format($item->total_price, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">
                                        <i class="fas fa-inbox fs-3 mb-2 d-block"></i>
                                        Tidak ada transaksi pada periode tanggal ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                        @if($bookings->count() > 0)
                            <tfoot class="table-light fw-bold">
                                <tr>
                                    <th colspan="6" class="text-end text-uppercase">Total Keseluruhan:</th>
                                    <th class="text-end text-primary fs-6">
                                        Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                                    </th>
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
        table tfoot th {
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
            min-width: 750px;
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
        $('#table-laporan').DataTable({
            sorting: false,
            paging: false,
            info: false,
            searching: false,
            lengthChange: false
        });
    });
</script>
@endpush