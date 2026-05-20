@extends("admin.layouts.app")

@section("content_title", "Data Pelanggan")

@section("content")
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Data Pelanggan</h4>

        <div class="d-flex justify-content-end mb-2">
            <x-admin.users.form-users />
        </div>
    </div>

    <div class="card-body">
        <x-admin.alert :error="$errors->any()" />

        <div class="table-responsive">
            <table class="table table-sm" id="datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pelanggan</th>
                        <th>Kontak</th>
                        <th>Alamat</th>
                        <th>Poin Loyalitas</th>
                        <th>Opsi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>

                            <td class="fw-bold">
                                {{ $item->name }}
                            </td>

                            <td>
                                <div class="d-flex flex-column">
                                    <span><i class="fas fa-envelope text-muted me-1"></i> {{ $item->email }}</span>
                                    <span><i class="fab fa-whatsapp text-success me-1"></i> {{ $item->whatsapp }}</span>
                                </div>
                            </td>

                            <td>
                                {{ $item->address ?? '-' }}
                            </td>

                            <td>
                                <span class="badge {{ $item->loyalty_points > 0 ? 'bg-light-primary text-primary' : 'bg-light-secondary text-secondary' }}">
                                    <i class="fas fa-star me-1"></i> {{ $item->loyalty_points }} Poin
                                </span>
                            </td>

                            <td>
                                <div class="d-flex align-items-center">

                                    {{-- Komponen Form Modal untuk Edit --}}
                                    <x-admin.users.form-users
                                        :id="$item->id"
                                        :name="$item->name"
                                        :email="$item->email"
                                        :whatsapp="$item->whatsapp"
                                        :address="$item->address"
                                        :loyalty-points="$item->loyalty_points"
                                    />

                                    {{-- Tombol Hapus --}}
                                    <a href="{{ route('admin.data-master.users.destroy', $item->id) }}"
                                       data-confirm-delete="true"
                                       class="btn btn-sm btn-danger mx-1 text-light">
                                        <i class="fas fa-trash"></i>
                                    </a>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection