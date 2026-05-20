@extends("admin.layouts.app")

@section("content_title", "Halaman Tidak Ditemukan")

@push('css')
<style>

    .pc-header {
        display: none !important;
    }

    .pc-container {
        margin-left: 0 !important;
        margin-top: 0 !important;
        padding-top: 0 !important;
        top: 0 !important; 
    }


    .pc-content {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh; 
        padding: 0 !important;
    }
</style>
@endpush

@section("content")
<div class="row justify-content-center w-100">
    <div class="col-md-6 text-center">
        <h1 class="display-1 fw-bold text-danger">404</h1>
        <h3 class="mb-3">Oops! Halaman Tidak Ditemukan.</h3>
        <p class="text-muted mb-4">
            Maaf, halaman yang Anda cari mungkin telah dihapus, namanya diubah, atau sementara tidak tersedia.
        </p>
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary me-2">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">
            <i class="fas fa-home"></i> Ke Dashboard
        </a>
    </div>
</div>
@endsection