@extends("admin.layouts.app")

@section("content_title", "Tambah Booking Walk-in")

@section("content")
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Form Input Kasir (Walk-in)</h4>
    </div>

    <div class="card-body">
        <x-admin.alert :error="$errors->any()" />

        <form action="{{ route('admin.transaksi.bookings.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="user_id" class="form-label fw-bold">Pilih Pelanggan <span class="text-danger">*</span></label>
                        {{-- Tambahkan class 'select2' --}}
                        <select name="user_id" id="user_id" class="form-select select2 @error('user_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Pelanggan --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->whatsapp }})
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="cat_id" class="form-label fw-bold">Pilih Kucing <span class="text-danger">*</span></label>
                        {{-- Tambahkan class 'select2' --}}
                        <select name="cat_id" id="cat_id" class="form-select select2 @error('cat_id') is-invalid @enderror" required disabled>
                            <option value="">-- Pilih Pelanggan Terlebih Dahulu --</option>
                            {{-- Opsi kucing akan diisi oleh jQuery + Select2 --}}
                        </select>
                        @error('cat_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="service_id" class="form-label fw-bold">Pilih Layanan <span class="text-danger">*</span></label>
                        {{-- Tambahkan class 'select2' --}}
                        <select name="service_id" id="service_id" class="form-select select2 @error('service_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Layanan --</option>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}" data-price="{{ $service->price }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                    {{ $service->name }} - Rp {{ number_format($service->price, 0, ',', '.') }} ({{ ucfirst($service->type) }})
                                </option>
                            @endforeach
                        </select>
                        @error('service_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="brought_items" class="form-label fw-bold">Barang Bawaan / Catatan Tambahan</label>
                        <textarea name="brought_items" id="brought_items" rows="3" class="form-control" placeholder="Contoh: Kandang merk X, pakan kemasan 1kg, vitamin kucing dll.">{{ old('brought_items') }}</textarea>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="start_date" class="form-label fw-bold">Tanggal Mulai <span class="text-danger">*</span></label>
                        <input type="date" name="start_date" id="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date', date('Y-m-d')) }}" required>
                        @error('start_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="end_date" class="form-label fw-bold">Tanggal Selesai <span class="text-muted">(Khusus Penitipan/Boarding)</span></label>
                        <input type="date" name="end_date" id="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date') }}">
                        @error('end_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="total_price" class="form-label fw-bold">Total Harga (Rp) <span class="text-danger">*</span></label>
                        <input type="number" name="total_price" id="total_price" class="form-control @error('total_price') is-invalid @enderror" value="{{ old('total_price', 0) }}" required min="0">
                        @error('total_price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="down_payment" class="form-label fw-bold">Uang Muka / DP (Rp)</label>
                        <input type="number" name="down_payment" id="down_payment" class="form-control @error('down_payment') is-invalid @enderror" value="{{ old('down_payment', 0) }}" min="0">
                        <small class="text-muted">Isi 0 atau samakan dengan total harga jika pelanggan langsung bayar lunas.</small>
                        @error('down_payment')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mt-4 border-top pt-3 d-flex justify-content-end">
                <a href="{{ route('admin.transaksi.bookings.index') }}" class="btn btn-secondary me-2">Kembali</a>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save me-1"></i> Simpan Transaksi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

{{-- Menggunakan @push('js') agar script masuk ke bawah jQuery & Select2 di layout --}}
@push('js')
<script>
    $(document).ready(function () {
        // 1. Inisialisasi Select2
        $('.select2').select2({
            width: '100%'
        });

        // Simpan data kucing dari PHP ke variabel JavaScript Array
        const catsData = [
            @foreach($cats as $cat)
                { 
                    id: "{{ $cat->id }}", 
                    text: "{{ $cat->name }} {{ $cat->breed ? '('.$cat->breed.')' : '' }}", 
                    userId: "{{ $cat->user_id }}" 
                },
            @endforeach
        ];

        // 2. Logika Filter Kucing Berdasarkan Pelanggan dengan Select2
        $('#user_id').on('change', function () {
            let selectedUserId = $(this).val();
            let $catSelect = $('#cat_id');

            // Kosongkan opsi sebelumnya
            $catSelect.empty();

            if (!selectedUserId) {
                $catSelect.append('<option value="">-- Pilih Pelanggan Terlebih Dahulu --</option>');
                $catSelect.prop('disabled', true);
            } else {
                // Filter kucing yang user_id nya sama dengan pelanggan yang dipilih
                let filteredCats = catsData.filter(cat => cat.userId === selectedUserId);

                if (filteredCats.length === 0) {
                    $catSelect.append('<option value="">Pelanggan ini belum mendaftarkan kucing</option>');
                    $catSelect.prop('disabled', true);
                } else {
                    $catSelect.append('<option value="">-- Pilih Kucing --</option>');
                    // Masukkan kucing ke dalam dropdown
                    filteredCats.forEach(cat => {
                        let newOption = new Option(cat.text, cat.id, false, false);
                        $catSelect.append(newOption);
                    });
                    $catSelect.prop('disabled', false);
                }
            }

            // Beri tahu Select2 bahwa datanya sudah berubah agar tampilannya di-refresh
            $catSelect.trigger('change');
        });

        // 3. Logika Auto-Fill Harga Berdasarkan Layanan yang Dipilih
        $('#service_id').on('change', function () {
            // Ambil atribut data-price dari option yang sedang dipilih
            let price = $(this).find(':selected').data('price');
            
            if (price) {
                $('#total_price').val(Math.round(price));
            } else {
                $('#total_price').val(0);
            }
        });

        // Jika ada old('user_id') karena error validasi, trigger otomatis saat halaman dimuat
        if ($('#user_id').val()) {
            $('#user_id').trigger('change');
            // Pilih kembali kucing yang sudah di-select sebelumnya (old value)
            let oldCatId = "{{ old('cat_id') }}";
            if(oldCatId) {
                $('#cat_id').val(oldCatId).trigger('change');
            }
        }
    });
</script>
@endpush