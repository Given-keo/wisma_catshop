@extends('customer.layouts.app') 
@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">+ Tambah Data Kucing</h2>
        <a href="{{ route('customer.cats.index') }}" class="btn btn-secondary btn-sm shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4 border-0">
        <div class="card-header py-3 bg-white">
            <h6 class="m-0 font-weight-bold text-primary">Informasi Profil Kucing</h6>
        </div>
        <div class="card-body">
            
            <form action="{{ route('customer.cats.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-8">
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label fw-bold">Nama Kucing <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan nama panggilan" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="gender" class="form-label fw-bold">Jenis Kelamin <span class="text-danger">*</span></label>
                                <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                                    <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                    <option value="Jantan" {{ old('gender') == 'Jantan' ? 'selected' : '' }}>Jantan</option>
                                    <option value="Betina" {{ old('gender') == 'Betina' ? 'selected' : '' }}>Betina</option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="breed" class="form-label fw-bold">Ras/Jenis</label>
                                <input type="text" class="form-control @error('breed') is-invalid @enderror" id="breed" name="breed" value="{{ old('breed') }}" placeholder="Cth: Persia, Domestik">
                                @error('breed')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="age" class="form-label fw-bold">Umur</label>
                                <input type="text" class="form-control @error('age') is-invalid @enderror" id="age" name="age" value="{{ old('age') }}" placeholder="Cth: 1 Tahun 2 Bulan">
                                @error('age')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="color" class="form-label fw-bold">Warna Bulu</label>
                                <input type="text" class="form-control @error('color') is-invalid @enderror" id="color" name="color" value="{{ old('color') }}" placeholder="Cth: Putih Corak Hitam">
                                @error('color')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="health_notes" class="form-label fw-bold">Catatan Kesehatan (Opsional)</label>
                            <textarea class="form-control @error('health_notes') is-invalid @enderror" id="health_notes" name="health_notes" rows="3" placeholder="Contoh: Alergi ayam, sedang pemulihan flu, atau tidak suka dipegang perutnya.">{{ old('health_notes') }}</textarea>
                            <small class="text-muted">Informasi ini sangat penting bagi kami saat merawat kucing Anda.</small>
                            @error('health_notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="col-md-4 text-center">
                        <label class="form-label fw-bold">Foto Kucing</label>
                        
                        <div class="mb-3">
                            <img id="imagePreview" src="https://placehold.co/400x400?text=Pilih+Foto" alt="Preview Foto" class="img-thumbnail rounded-circle" style="width: 200px; height: 200px; object-fit: cover;">
                        </div>

                        <input class="form-control mt-2 @error('photo') is-invalid @enderror" type="file" id="photo" name="photo" accept="image/jpeg,image/png,image/jpg" onchange="previewImage(event)">
                        <small class="text-muted d-block mt-1">Format: JPG/PNG, Maksimal: 2MB.</small>
                        @error('photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <hr>
                
                <div class="d-flex justify-content-end">
                    <button type="reset" class="btn btn-light me-2">Reset</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Data Kucing
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>

<script>
    function previewImage(event) {
        const input = event.target;
        const reader = new FileReader();
        
        reader.onload = function(){
            const dataURL = reader.result;
            const imagePreview = document.getElementById('imagePreview');
            imagePreview.src = dataURL;
        };
        
        if(input.files && input.files[0]) {
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection