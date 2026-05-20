@extends("admin.layouts.app")

@section("content_title","Data Layanan")

@section("content")
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Data Layanan</h4>

        <div class="d-flex justify-content-end mb-2">
            <x-admin.services.form-services />
        </div>
    </div>

    <div class="card-body">
        <x-admin.alert :error="$errors->any()" />

        <div class="table-responsive">
            <table class="table table-sm" id="datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Layanan</th>
                        <th>Tipe</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Deskripsi</th>
                        <th>Opsi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($services as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>

                            <td class="fw-bold">
                                {{ $item->name }}
                            </td>

                            <td>
                                <span class="badge 
                                    {{ $item->type == 'grooming' 
                                        ? 'bg-light-primary text-primary' 
                                        : 'bg-light-info text-info' }}">
                                        
                                    {{ ucfirst($item->type) }}
                                </span>
                            </td>

                            <td>
                                Rp {{ number_format($item->price, 0, ',', '.') }}
                            </td>

                            <td>
                                <span class="badge 
                                    {{ $item->is_active 
                                        ? 'bg-light-success text-success' 
                                        : 'bg-light-danger text-danger' }}">
                                        
                                    {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>

                            <td>
                                {{ $item->description ?? '-' }}
                            </td>

                            <td>
                                <div class="d-flex align-items-center">

                                    <x-admin.services.form-services
                                        :id="$item->id"
                                        :name="$item->name"
                                        :type="$item->type"
                                        :price="$item->price"
                                        :description="$item->description"
                                        :is-active="$item->is_active"
                                    />

                                    {{-- Tombol Hapus --}}
                                    <a href="{{ route('admin.data-master.services.destroy', $item->id) }}"
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