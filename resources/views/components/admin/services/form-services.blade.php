@props([
    'id' => null,
    'name' => '',
    'type' => '',
    'price' => '',
    'description' => '',
    'isActive' => true
])

<div>

    {{-- Tombol --}}
    <button type="button"
        class="btn {{ $id ? 'btn-warning btn-sm' : 'btn-primary btn-sm' }}"
        data-bs-toggle="modal"
        data-bs-target="#formService{{ $id ?? 'Tambah' }}">

        @if($id)
            <i class="fas fa-edit text-light"></i>
        @else
            <i class="fas fa-plus"></i> Tambah Layanan
        @endif
    </button>

    {{-- Modal --}}
    <div class="modal fade"
         id="formService{{ $id ?? 'Tambah' }}"
         tabindex="-1"
         aria-hidden="true">

        <div class="modal-dialog">
            <form action="{{ route('admin.data-master.services.store') }}"
                  method="POST">

                @csrf

                <input type="hidden"
                       name="id"
                       value="{{ $id }}">

                <div class="modal-content">

                    {{-- Header --}}
                    <div class="modal-header">
                        <h4 class="modal-title">
                            {{ $id ? 'Form Edit Layanan' : 'Form Tambah Layanan' }}
                        </h4>

                        <button type="button"
                                class="btn-close"
                                data-bs-dismiss="modal">
                        </button>
                    </div>

                    {{-- Body --}}
                    <div class="modal-body text-start">

                        {{-- Nama Layanan --}}
                        <div class="form-group mb-3">
                            <label class="form-label">
                                Nama Layanan
                            </label>

                            <input type="text"
                                   name="name"
                                   class="form-control"
                                   value="{{ $id ? $name : old('name') }}"
                                   placeholder="Contoh: Grooming Kucing Premium"
                                   required>
                        </div>

                        <div class="row">

                            {{-- Tipe --}}
                            <div class="col-md-6">
                                <div class="form-group mb-3">

                                    <label class="form-label">
                                        Tipe Layanan
                                    </label>

                                    <select name="type"
                                            class="form-select"
                                            required>

                                        <option value="">
                                            -- Pilih Tipe --
                                        </option>

                                        <option value="grooming"
                                            {{ ($id ? $type : old('type')) == 'grooming' ? 'selected' : '' }}>
                                            Grooming
                                        </option>

                                        <option value="boarding"
                                            {{ ($id ? $type : old('type')) == 'boarding' ? 'selected' : '' }}>
                                            Boarding
                                        </option>

                                    </select>
                                </div>
                            </div>

                            {{-- Harga --}}
                            <div class="col-md-6">
                                <div class="form-group mb-3">

                                    <label class="form-label">
                                        Harga
                                    </label>

                                    <input type="number"
                                           name="price"
                                           class="form-control"
                                           value="{{ $id ? $price : old('price') }}"
                                           placeholder="50000"
                                           min="0"
                                           required>

                                </div>
                            </div>

                        </div>

                        {{-- Deskripsi --}}
                        <div class="form-group mb-3">

                            <label class="form-label">
                                Deskripsi
                            </label>

                            <textarea name="description"
                                      rows="3"
                                      class="form-control"
                                      placeholder="Masukkan deskripsi layanan">{{ $id ? $description : old('description') }}</textarea>

                        </div>

                        {{-- Status Aktif --}}
                        <div class="form-check form-switch">

                            <input class="form-check-input"
                                   type="checkbox"
                                   name="is_active"
                                   value="1"
                                   id="is_active{{ $id }}"
                                   {{ ($id ? $isActive : old('is_active')) ? 'checked' : '' }}>

                            <label class="form-check-label"
                                   for="is_active{{ $id }}">
                                Status Aktif
                            </label>

                        </div>

                    </div>

                    {{-- Footer --}}
                    <div class="modal-footer">

                        <button type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal">
                            Batal
                        </button>

                        <button type="submit"
                                class="btn btn-primary">
                            Simpan Data
                        </button>

                    </div>

                </div>
            </form>
        </div>
    </div>
</div>