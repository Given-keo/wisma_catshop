@extends("admin.layouts.app")

@section("content_title", "Isi Laporan Harian")

@section("content")
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-light">
                <h4 class="card-title">Informasi Titipan</h4>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <span class="d-block text-muted" style="font-size: 0.85em;">Kode Booking</span>
                    <span class="fw-bold text-primary">{{ $booking->booking_code }}</span>
                </div>
                <div class="mb-3">
                    <span class="d-block text-muted" style="font-size: 0.85em;">Nama Kucing</span>
                    <span class="fw-bold">{{ $booking->cat->name ?? '-' }}</span> 
                    <small>({{ $booking->cat->breed ?? 'Ras tidak diketahui' }})</small>
                </div>
                <div class="mb-3">
                    <span class="d-block text-muted" style="font-size: 0.85em;">Pemilik</span>
                    <span class="fw-bold">{{ $booking->user->name ?? '-' }}</span>
                </div>
                <div class="mb-3">
                    <span class="d-block text-muted" style="font-size: 0.85em;">Periode Menginap</span>
                    <span class="fw-bold">
                        {{ \Carbon\Carbon::parse($booking->start_date)->format('d M Y') }}
                        s/d 
                        {{ $booking->end_date ? \Carbon\Carbon::parse($booking->end_date)->format('d M Y') : '?' }}
                    </span>
                </div>
                <hr>
                <div class="mb-0">
                    <span class="d-block text-muted mb-1" style="font-size: 0.85em;">Catatan/Barang Bawaan saat masuk:</span>
                    <p class="small bg-light p-2 rounded border">{{ $booking->brought_items ?? 'Tidak ada catatan.' }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Kondisi Harian</h4>
            </div>

            <div class="card-body">
                <x-admin.alert :error="$errors->any()" />

                <form action="{{ route('admin.transaksi.boarding_logs.store', $booking->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="log_date" class="form-label fw-bold">Tanggal Laporan <span class="text-danger">*</span></label>
                        <input type="date" name="log_date" id="log_date" 
                               class="form-control @error('log_date') is-invalid @enderror" 
                               value="{{ old('log_date', date('Y-m-d')) }}" required>
                        @error('log_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="eating_condition" class="form-label fw-bold">Kondisi Makan <span class="text-danger">*</span></label>
                        <select name="eating_condition" id="eating_condition" class="form-select @error('eating_condition') is-invalid @enderror" required>
                            <option value="">-- Pilih Kondisi --</option>
                            <option value="Sangat Lahap" {{ old('eating_condition') == 'Sangat Lahap' ? 'selected' : '' }}>Sangat Lahap</option>
                            <option value="Normal / Habis" {{ old('eating_condition') == 'Normal / Habis' ? 'selected' : '' }}>Normal / Habis</option>
                            <option value="Sedikit / Bersisa" {{ old('eating_condition') == 'Sedikit / Bersisa' ? 'selected' : '' }}>Sedikit / Bersisa</option>
                            <option value="Tidak Mau Makan" {{ old('eating_condition') == 'Tidak Mau Makan' ? 'selected' : '' }}>Tidak Mau Makan</option>
                        </select>
                        @error('eating_condition')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="activity" class="form-label fw-bold">Aktivitas & Mood <span class="text-danger">*</span></label>
                        <select name="activity" id="activity" class="form-select @error('activity') is-invalid @enderror" required>
                            <option value="">-- Pilih Aktivitas --</option>
                            <option value="Sangat Aktif & Bermain" {{ old('activity') == 'Sangat Aktif & Bermain' ? 'selected' : '' }}>Sangat Aktif & Bermain</option>
                            <option value="Aktif Normal" {{ old('activity') == 'Aktif Normal' ? 'selected' : '' }}>Aktif Normal</option>
                            <option value="Banyak Tidur / Santai" {{ old('activity') == 'Banyak Tidur / Santai' ? 'selected' : '' }}>Banyak Tidur / Santai</option>
                            <option value="Terlihat Takut / Agresif" {{ old('activity') == 'Terlihat Takut / Agresif' ? 'selected' : '' }}>Terlihat Takut / Agresif</option>
                            <option value="Lesu" {{ old('activity') == 'Lesu' ? 'selected' : '' }}>Lesu</option>
                        </select>
                        @error('activity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="health_notes" class="form-label fw-bold">Catatan Kesehatan / Lainnya (Opsional)</label>
                        <textarea name="health_notes" id="health_notes" rows="3" 
                                  class="form-control @error('health_notes') is-invalid @enderror" 
                                  placeholder="Contoh: Pup normal, tapi sedikit flu. Sudah diberi vitamin.">{{ old('health_notes') }}</textarea>
                        @error('health_notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="photo" class="form-label fw-bold">Foto Kucing (Opsional)</label>
                        <input type="file" name="photo" id="photo" 
                               class="form-control @error('photo') is-invalid @enderror"
                               accept="image/jpeg,image/png,image/jpg">
                        @error('photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Format: JPEG/PNG, maksimal 2MB.</div>
                    </div>

                    <div class="mt-4 border-top pt-3 d-flex justify-content-end">
                        <a href="{{ route('admin.transaksi.boarding_logs.index') }}" class="btn btn-secondary me-2">Kembali</a>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save me-1"></i> Simpan Laporan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection