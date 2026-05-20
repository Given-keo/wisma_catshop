@extends('customer.layouts.app') 

@section('content')


<style>
    .custom-card-input { 
        border: 2px solid #e3e6f0; 
        transition: all 0.3s ease-in-out; 
        position: relative;
        overflow: hidden;
    }
    .custom-card-input:hover { 
        border-color: #b7b9cc; 
        transform: translateY(-3px);
    }

    .custom-card-input.selected-card { 
        border-color: #4e73df !important; 
        background-color: #f8f9fc !important; 
        box-shadow: 0 0.5rem 1rem rgba(78, 115, 223, 0.15) !important;
    }
    
    .check-mark {
        position: absolute;
        top: 10px;
        right: 10px;
        color: #4e73df;
        font-size: 1.5rem;
        opacity: 0;
        transform: scale(0.5);
        transition: all 0.3s ease-in-out;
        z-index: 2;
    }
    .custom-card-input.selected-card .check-mark {
        opacity: 1;
        transform: scale(1);
    }
</style>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Booking Layanan</h2>
        <a href="{{ route('customer.bookings.index') }}" class="btn btn-secondary btn-sm shadow-sm" onclick="return confirm('Batalkan pengisian booking?')">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4 border-0">
        <div class="card-body bg-light rounded">
            <div class="row text-center position-relative">
                <div class="col-3 step-indicator active" id="ind-1">
                    <div class="badge bg-primary rounded-circle p-2 mb-2 px-3">1</div>
                    <div class="small fw-bold d-none d-md-block">Pilih Layanan</div>
                </div>
                <div class="col-3 step-indicator text-muted" id="ind-2">
                    <div class="badge bg-secondary rounded-circle p-2 mb-2 px-3">2</div>
                    <div class="small fw-bold d-none d-md-block">Pilih Kucing</div>
                </div>
                <div class="col-3 step-indicator text-muted" id="ind-3">
                    <div class="badge bg-secondary rounded-circle p-2 mb-2 px-3">3</div>
                    <div class="small fw-bold d-none d-md-block">Atur Tanggal</div>
                </div>
                <div class="col-3 step-indicator text-muted" id="ind-4">
                    <div class="badge bg-secondary rounded-circle p-2 mb-2 px-3">4</div>
                    <div class="small fw-bold d-none d-md-block">Konfirmasi Pemesanan</div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4 border-0">
        <div class="card-body">
            <form action="{{ route('customer.bookings.store') }}" method="POST" id="wizardForm">
                @csrf

                <div class="wizard-step" id="step-1">
                    <h5 class="fw-bold mb-4 text-primary"> langkah 1: Pilih Layanan Perawatan / Penitipan</h5>
                    <div class="row">
                        @foreach($services as $service)
                            <div class="col-md-4 mb-3">
                                <label class="card h-100 shadow-sm custom-card-input p-3 text-center border-2" style="cursor: pointer;">
                                    
                                    <i class="fas fa-check-circle check-mark bg-white rounded-circle"></i>
                                    
                                    <input type="radio" name="service_id" value="{{ $service->id }}" class="card-radio d-none" 
                                            data-name="{{ $service->name }}" data-price="{{ $service->price }}" data-type="{{ $service->type }}" required>
                                    
                                    <div class="card-content">
                                        <div class="fs-1 mb-2 text-primary">
                                            <i class="{{ $service->type === 'grooming' ? 'fas fa-bath' : 'fas fa-hotel' }}"></i>
                                        </div>
                                        <h5 class="fw-bold mb-1 text-dark">{{ $service->name }}</h5>
                                        <span class="badge bg-light text-capitalize text-secondary border mb-2">{{ $service->type }}</span>
                                        <p class="text-muted small text-start mb-3">{{ $service->description ?? 'Tidak ada deskripsi.' }}</p>
                                        <div class="fw-bold text-success fs-5">Rp {{ number_format($service->price, 0, ',', '.') }}<small class="text-muted fs-6">{{ $service->type === 'boarding' ? '/hari' : '' }}</small></div>
                                    </div>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="wizard-step d-none" id="step-2">
                    <h5 class="fw-bold mb-4 text-primary"> langkah 2: Pilih Kucing Kesayangan</h5>
                    <div class="row">
                        @forelse($cats as $cat)
                            <div class="col-md-3 mb-3">
                                <label class="card h-100 shadow-sm custom-card-input text-center border-2" style="cursor: pointer;">
                                    
                                    <i class="fas fa-check-circle check-mark bg-white rounded-circle"></i>
                                    
                                    <input type="radio" name="cat_id" value="{{ $cat->id }}" class="card-radio d-none" data-name="{{ $cat->name }}" required>
                                    
                                    <img src="{{ $cat->photo ? asset('storage/' . $cat->photo) : 'https://placehold.co/150?text=Meow' }}" class="card-img-top" style="height: 150px; object-fit: cover;">
                                    <div class="card-body p-2">
                                        <h6 class="fw-bold mb-0 text-dark">{{ $cat->name }}</h6>
                                        <small class="text-muted">{{ $cat->breed ?? 'Ras Campuran' }}</small>
                                    </div>
                                </label>
                            </div>
                        @empty
                            <div class="col-12 text-center py-4">
                                <p class="text-muted">Kamu belum mendaftarkan data kucing peliharaan.</p>
                                <a href="{{ route('customer.cats.create') }}" class="btn btn-sm btn-primary">Tambah Kucing Dulu</a>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="wizard-step d-none" id="step-3">
                    <h5 class="fw-bold mb-4 text-primary"> langkah 3: Tentukan Jadwal Kedatangan</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="start_date" class="form-label fw-bold">Tanggal Mulai / Masuk <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="start_date" name="start_date" min="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-6 mb-3" id="end_date_container">
                            <label for="end_date" class="form-label fw-bold">Tanggal Selesai / Keluar <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="end_date" name="end_date">
                            <small class="text-muted">*Wajib diisi khusus untuk layanan penitipan (boarding).</small>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="brought_items" class="form-label fw-bold">Barang Bawaan / Catatan Khusus (Opsional)</label>
                            <textarea class="form-control" id="brought_items" name="brought_items" rows="3" placeholder="Contoh: Membawa pakan sendiri merk X, kandang sendiri, atau selimut kesukaan kucing."></textarea>
                        </div>
                    </div>
                </div>

                <div class="wizard-step d-none" id="step-4">
                    <h5 class="fw-bold mb-4 text-primary"> langkah 4: Ringkasan & Konfirmasi Pemesanan</h5>
                    <div class="alert alert-info">
                        Silakan periksa kembali detail pesanan Anda sebelum membuat pesanan. Pembayaran QRIS akan diproses pada halaman berikutnya.
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered bg-light">
                                <tr><th width="40%">Layanan</th><td id="review-service">-</td></tr>
                                <tr><th>Kucing</th><td id="review-cat">-</td></tr>
                                <tr><th>Tanggal Masuk</th><td id="review-start">-</td></tr>
                                <tr id="review-end-row"><th>Tanggal Keluar</th><td id="review-end">-</td></tr>
                                <tr id="review-days-row"><th>Total Hari</th><td id="review-days">-</td></tr>
                            </table>
                        </div>
                        <div class="col-md-6 text-center d-flex flex-column justify-content-center border rounded p-4 bg-white shadow-inner">
                            <h5 class="text-muted fw-bold">TOTAL BIAYA</h5>
                            <h2 class="text-success fw-bold" id="review-total-price">Rp 0</h2>
                            <input type="hidden" name="total_price" id="total_price_input" value="0">
                        </div>
                    </div>
                </div>

                <hr class="mt-4">
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary px-4 d-none" id="btnPrev">Sebelumnya</button>
                    <button type="button" class="btn btn-primary px-4 ms-auto" id="btnNext">Selanjutnya</button>
                    <button type="submit" class="btn btn-success px-4 d-none" id="btnSubmit">
                        <i class="fas fa-check-circle"></i> Buat Pesanan Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    let currentStep = 1;
    const totalSteps = 4;

    const btnNext = document.getElementById('btnNext');
    const btnPrev = document.getElementById('btnPrev');
    const btnSubmit = document.getElementById('btnSubmit');

    document.querySelectorAll('.card-radio').forEach(radio => {
        radio.addEventListener('change', function() {
            const groupName = this.name;
            
            document.querySelectorAll(`input[name="${groupName}"]`).forEach(input => {
                input.closest('.custom-card-input').classList.remove('selected-card');
            });
            
            if (this.checked) {
                this.closest('.custom-card-input').classList.add('selected-card');
            }
        });
    });

    btnNext.addEventListener('click', () => {
        if (validateStep(currentStep)) {
            currentStep++;
            updateWizardView();
        }
    });

    btnPrev.addEventListener('click', () => {
        currentStep--;
        updateWizardView();
    });

    function updateWizardView() {

        document.querySelectorAll('.wizard-step').forEach((step, index) => {
            step.classList.toggle('d-none', index + 1 !== currentStep);
        });

        document.querySelectorAll('.step-indicator').forEach((ind, index) => {
            if (index + 1 === currentStep) {
                ind.className = 'col-3 step-indicator active text-primary';
                ind.querySelector('.badge').className = 'badge bg-primary rounded-circle p-2 mb-2 px-3';
            } else if (index + 1 < currentStep) {
                ind.className = 'col-3 step-indicator text-success';
                ind.querySelector('.badge').className = 'badge bg-success rounded-circle p-2 mb-2 px-3';
            } else {
                ind.className = 'col-3 step-indicator text-muted';
                ind.querySelector('.badge').className = 'badge bg-secondary rounded-circle p-2 mb-2 px-3';
            }
        });


        btnPrev.classList.toggle('d-none', currentStep === 1);
        btnNext.classList.toggle('d-none', currentStep === totalSteps);
        btnSubmit.classList.toggle('d-none', currentStep !== totalSteps);

        if (currentStep === totalSteps) {
            compileReviewData();
        }
    }

    function validateStep(step) {
        if (step === 1) {
            const selectedService = document.querySelector('input[name="service_id"]:checked');
            if (!selectedService) { alert('Silakan pilih salah satu layanan terlebih dahulu!'); return false; }
            
            const serviceType = selectedService.getAttribute('data-type');
            const endDateContainer = document.getElementById('end_date_container');
            const endDateInput = document.getElementById('end_date');
            if(serviceType === 'grooming') {
                endDateContainer.classList.add('d-none');
                endDateInput.required = false;
                endDateInput.value = '';
            } else {
                endDateContainer.classList.remove('d-none');
                endDateInput.required = true;
            }
        }
        if (step === 2) {
            const selectedCat = document.querySelector('input[name="cat_id"]:checked');
            if (!selectedCat) { alert('Silakan pilih salah satu kucing Anda!'); return false; }
        }
        if (step === 3) {
            const startDate = document.getElementById('start_date').value;
            const endDate = document.getElementById('end_date').value;
            const selectedService = document.querySelector('input[name="service_id"]:checked');
            
            if (!startDate) { alert('Tanggal mulai wajib ditentukan!'); return false; }
            if (selectedService.getAttribute('data-type') === 'boarding' && !endDate) {
                alert('Untuk penitipan (boarding), tanggal keluar wajib diisi!'); return false;
            }
            if (endDate && endDate < startDate) {
                alert('Tanggal keluar tidak boleh mendahului tanggal masuk!'); return false;
            }
        }
        return true;
    }

    function compileReviewData() {
        const serviceRadio = document.querySelector('input[name="service_id"]:checked');
        const catRadio = document.querySelector('input[name="cat_id"]:checked');
        const startDateVal = document.getElementById('start_date').value;
        const endDateVal = document.getElementById('end_date').value;

        document.getElementById('review-service').innerText = serviceRadio.getAttribute('data-name');
        document.getElementById('review-cat').innerText = catRadio.getAttribute('data-name');
        document.getElementById('review-start').innerText = startDateVal;

        const basePrice = parseFloat(serviceRadio.getAttribute('data-price'));
        const serviceType = serviceRadio.getAttribute('data-type');

        if (serviceType === 'boarding' && endDateVal) {
            document.getElementById('review-end-row').classList.remove('d-none');
            document.getElementById('review-days-row').classList.remove('d-none');
            document.getElementById('review-end').innerText = endDateVal;

            const start = new Date(startDateVal);
            const end = new Date(endDateVal);
            const timeDiff = Math.abs(end.getTime() - start.getTime());
            let days = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));
            if(days === 0) days = 1; 

            document.getElementById('review-days').innerText = days + " Hari";
            const finalPrice = basePrice * days;
            document.getElementById('review-total-price').innerText = "Rp " + finalPrice.toLocaleString('id-ID');
            document.getElementById('total_price_input').value = finalPrice;
        } else {
            document.getElementById('review-end-row').classList.add('d-none');
            document.getElementById('review-days-row').classList.add('d-none');
            document.getElementById('review-total-price').innerText = "Rp " + basePrice.toLocaleString('id-ID');
            document.getElementById('total_price_input').value = basePrice;
        }
    }
</script>
@endsection