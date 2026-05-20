
@props([
    'id' => null,
    'userId' => '',
    'users' => [],
    'name' => '',
    'breed' => '',
    'gender' => '',
    'age' => '',
    'color' => '',
    'healthNotes' => ''
])

<div>

    {{-- Tombol --}}
    <button type="button"
        class="btn {{ $id ? 'btn-warning btn-sm' : 'btn-primary btn-sm' }}"
        data-bs-toggle="modal"
        data-bs-target="#formCat{{ $id ?? 'Tambah' }}">

        @if($id)
            <i class="fas fa-edit text-light"></i>
        @else
            <i class="fas fa-plus"></i> Tambah Kucing
        @endif
    </button>

    {{-- Modal --}}
    <div class="modal fade"
         id="formCat{{ $id ?? 'Tambah' }}"
         tabindex="-1"
         aria-hidden="true">

        <div class="modal-dialog modal-lg">
            <form action="{{ route('admin.data-master.cats.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <input type="hidden"
                       name="id"
                       value="{{ $id }}">

                <div class="modal-content">

                    {{-- Header --}}
                    <div class="modal-header">
                        <h4 class="modal-title">
                            {{ $id ? 'Form Edit Data Kucing' : 'Form Tambah Data Kucing' }}
                        </h4>

                        <button type="button"
                                class="btn-close"
                                data-bs-dismiss="modal">
                        </button>
                    </div>

                    {{-- Body --}}
                    <div class="modal-body text-start">

                        <div class="row">
                            {{-- Pemilik Kucing --}}
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">
                                        Pemilik Kucing
                                    </label>

                                    <select name="user_id"
                                            class="form-select select2"
                                            required>

                                        <option value="">
                                            -- Pilih Pemilik --
                                        </option>

                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ ($id ? $userId : old('user_id')) == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }} - {{ $user->whatsapp }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            {{-- Nama Kucing --}}
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">
                                        Nama Kucing
                                    </label>

                                    <input type="text"
                                           name="name"
                                           class="form-control"
                                           value="{{ $id ? $name : old('name') }}"
                                           placeholder="Contoh: Mochi"
                                           required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            {{-- Ras Kucing --}}
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">
                                        Ras (Breed)
                                    </label>

                                    <input type="text"
                                           name="breed"
                                           class="form-control"
                                           value="{{ $id ? $breed : old('breed') }}"
                                           placeholder="Contoh: Persia">
                                </div>
                            </div>

                            {{-- Jenis Kelamin --}}
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">
                                        Jenis Kelamin
                                    </label>

                                    <select name="gender" class="form-select">
                                        <option value="">-- Pilih --</option>
                                        <option value="Jantan" {{ ($id ? $gender : old('gender')) == 'Jantan' ? 'selected' : '' }}>
                                            Jantan
                                        </option>
                                        <option value="Betina" {{ ($id ? $gender : old('gender')) == 'Betina' ? 'selected' : '' }}>
                                            Betina
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            {{-- Umur --}}
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">
                                        Umur
                                    </label>

                                    <input type="text"
                                           name="age"
                                           class="form-control"
                                           value="{{ $id ? $age : old('age') }}"
                                           placeholder="Contoh: 1 Tahun 2 Bulan">
                                </div>
                            </div>

                            {{-- Warna --}}
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">
                                        Warna Bulu
                                    </label>

                                    <input type="text"
                                           name="color"
                                           class="form-control"
                                           value="{{ $id ? $color : old('color') }}"
                                           placeholder="Contoh: Putih Corak Oren">
                                </div>
                            </div>
                        </div>

                        {{-- Upload Foto --}}
                        <div class="form-group mb-3">
                            <label class="form-label">
                                Foto Kucing
                                @if($id) 
                                    <small class="text-muted">(Kosongkan jika tidak diubah)</small> 
                                @endif
                            </label>

                            <input type="file"
                                   name="photo"
                                   class="form-control"
                                   accept="image/jpeg,image/png,image/jpg">
                        </div>

                        {{-- Catatan Kesehatan --}}
                        <div class="form-group mb-3">
                            <label class="form-label">
                                Catatan Kesehatan / Riwayat Medis
                            </label>

                            <textarea name="health_notes"
                                      rows="3"
                                      class="form-control"
                                      placeholder="Contoh: Alergi ayam, pernah operasi batu ginjal...">{{ $id ? $healthNotes : old('health_notes') }}</textarea>
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

@push('js')
<script>
    $(document).ready(function () {

        $('#formCat{{ $id ?? "Tambah" }}').on('shown.bs.modal', function () {

            $(this).find('.select2').select2({
                dropdownParent: $('#formCat{{ $id ?? "Tambah" }}'),
                width: '100%',
                placeholder: '-- Pilih Pemilik --'
            });

        });

    });
</script>
@endpush
