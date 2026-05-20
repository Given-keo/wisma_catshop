

<div>

    {{-- Tombol --}}
    <button type="button"
        class="btn {{ $id ? 'btn-warning btn-sm' : 'btn-primary btn-sm' }}"
        data-bs-toggle="modal"
        data-bs-target="#formUser{{ $id ?? 'Tambah' }}">

        @if($id)
            <i class="fas fa-edit text-light"></i>
        @else
            <i class="fas fa-plus"></i> Tambah Pelanggan
        @endif
    </button>

    {{-- Modal --}}
    <div class="modal fade"
         id="formUser{{ $id ?? 'Tambah' }}"
         tabindex="-1"
         aria-hidden="true">

        <div class="modal-dialog modal-lg">
            <form action="{{ route('admin.data-master.users.store') }}"
                  method="POST">

                @csrf

                <input type="hidden"
                       name="id"
                       value="{{ $id }}">

                <div class="modal-content">

                    {{-- Header --}}
                    <div class="modal-header">
                        <h4 class="modal-title">
                            {{ $id ? 'Form Edit Data Pelanggan' : 'Form Tambah Data Pelanggan' }}
                        </h4>

                        <button type="button"
                                class="btn-close"
                                data-bs-dismiss="modal">
                        </button>
                    </div>

                    {{-- Body --}}
                    <div class="modal-body text-start">

                        <div class="row">
                            {{-- Nama Pelanggan --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    Nama Lengkap Pelanggan
                                </label>
                                <input type="text"
                                       name="name"
                                       class="form-control"
                                       value="{{ $id ? $name : old('name') }}"
                                       placeholder="Contoh: John Doe"
                                       required>
                            </div>

                            {{-- Nomor WhatsApp --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    Nomor WhatsApp
                                </label>
                                <input type="text"
                                       name="whatsapp"
                                       class="form-control"
                                       value="{{ $id ? $whatsapp : old('whatsapp') }}"
                                       placeholder="Contoh: 08123456789"
                                       required>
                            </div>
                        </div>

                        <div class="row">
                            {{-- Email --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    Email
                                </label>
                                <input type="email"
                                       name="email"
                                       class="form-control"
                                       value="{{ $id ? $email : old('email') }}"
                                       placeholder="Contoh: john@example.com"
                                       required>
                            </div>

                            {{-- Password --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    Password Login
                                    @if($id)
                                        <small class="text-muted">(Kosongkan jika tidak ingin diubah)</small>
                                    @endif
                                </label>
                                <input type="password"
                                       name="password"
                                       class="form-control"
                                       placeholder="Minimal 8 karakter"
                                       {{ $id ? '' : 'required' }}>
                            </div>
                        </div>

                        <div class="row">
                            {{-- Alamat --}}
                            <div class="col-md-8 mb-3">
                                <label class="form-label">
                                    Alamat Lengkap
                                </label>
                                <textarea name="address"
                                          rows="2"
                                          class="form-control"
                                          placeholder="Masukkan alamat lengkap">{{ $id ? $address : old('address') }}</textarea>
                            </div>

                            {{-- Loyalty Points --}}
                            <div class="col-md-4 mb-3">
                                <label class="form-label">
                                    Poin Loyalitas
                                </label>
                                <input type="number"
                                       name="loyalty_points"
                                       class="form-control"
                                       value="{{ $id ? $loyaltyPoints : old('loyalty_points', 0) }}"
                                       min="0">
                            </div>
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