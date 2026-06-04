@extends('customer.layouts.app') 

@section('content')
<div class="container-fluid">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Kucingku</h2>
        <a href="{{ route('customer.cats.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Kucing Baru
        </a>
    </div>
    
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        @forelse ($cats as $cat)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    
                    <img src="{{ $cat->photo ? asset('storage/' . $cat->photo) : 'https://placehold.co/600x400?text=Meow!' }}" 
                         class="card-img-top" 
                         alt="Foto {{ $cat->name }}" 
                         style="height: 250px; object-fit: cover;">
                    
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold mb-3">
                            {{ $cat->name }} 
                            @if($cat->gender == 'Jantan')
                                <i class="fas fa-mars text-primary" title="Jantan"></i>
                            @else
                                <i class="fas fa-venus text-danger" title="Betina"></i>
                            @endif
                        </h5>
                        
                        <p class="card-text mb-1"><small class="text-muted">Ras:</small> {{ $cat->breed ?? 'Tidak diketahui' }}</p>
                        <p class="card-text mb-1"><small class="text-muted">Umur:</small> {{ $cat->age ?? '-' }}</p>
                        <p class="card-text mb-1"><small class="text-muted">Warna:</small> {{ $cat->color ?? '-' }}</p>
                        
                        @if($cat->health_notes)
                            <div class="alert alert-warning mt-3 mb-0 p-2" style="font-size: 0.85rem;">
                                <i class="fas fa-notes-medical"></i> <strong>Catatan Kesehatan:</strong><br>
                                {{ $cat->health_notes }}
                            </div>
                        @endif
                    </div>
                    
                    <div class="card-footer bg-white border-top d-flex justify-content-between">
                        <a href="{{ route('customer.cats.edit', $cat->id) }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-edit"></i> Edit Profil
                        </a>
                        
                        <form action="{{ route('customer.cats.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data si manis {{ $cat->name }}?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </div>

                </div>
            </div>

        @empty
            <div class="col-12">
                <div class="card text-center p-5 shadow-sm border-0">
                    <div class="card-body">
                        <i class="fas fa-cat fa-4x text-muted mb-3"></i>
                        <h5 class="card-title mt-2">Belum ada data kucing</h5>
                        <p class="card-text text-muted">Anda belum menambahkan profil kucing peliharaan. Yuk, tambahkan sekarang agar bisa mulai melakukan booking layanan!</p>
                        <a href="{{ route('customer.cats.create') }}" class="btn btn-primary mt-3">
                            <i class="fas fa-plus"></i> Tambah Kucing Sekarang
                        </a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

</div>
@endsection