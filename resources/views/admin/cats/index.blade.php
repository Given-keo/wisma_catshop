@extends("admin.layouts.app")

@section("content_title", "Data Kucing")

@section("content")
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Data Kucing</h4>

        <div class="d-flex justify-content-end mb-2">
            {{-- Ingat untuk mengirimkan data $users ke component form agar bisa dipakai di dropdown --}}
            <x-admin.cats.form-cats :users="$users" />
        </div>
    </div>

    <div class="card-body">
        <x-admin.alert :error="$errors->any()" />

        <div class="table-responsive">
            <table class="table table-sm" id="datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama Pemilik</th>
                        <th>Nama Kucing</th>
                        <th>Gender</th>
                        <th>Ras & Warna</th>
                        <th>Umur</th>
                        <th>Catatan Kesehatan</th>
                        <th>Opsi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($cats as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>

                            <td>
                                @if ($item->photo)
                                    <img src="{{ asset('storage/' . $item->photo) }}" alt="Foto {{ $item->name }}" class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <span class="text-muted fst-italic">Tanpa foto</span>
                                @endif
                            </td>

                            <td>
                                {{-- Memanggil nama dari relasi user --}}
                                {{ $item->user->name ?? 'Pemilik tidak ditemukan' }}
                            </td>

                            <td class="fw-bold">
                                {{ $item->name }}
                            </td>

                            <td>
                                <span class="badge 
                                    {{ $item->gender == 'Jantan' 
                                        ? 'bg-light-info text-info' 
                                        : 'bg-light-danger text-danger' }}">
                                    {{ $item->gender ?? '-' }}
                                </span>
                            </td>

                            <td>
                                {{ $item->breed ?? '-' }} 
                                @if($item->color) 
                                    <br> <small class="text-muted">({{ $item->color }})</small> 
                                @endif
                            </td>

                            <td>
                                {{ $item->age ?? '-' }}
                            </td>

                            <td>
                                {{ $item->health_notes ?? '-' }}
                            </td>

                            <td>
                                <div class="d-flex align-items-center">

                                    {{-- Kirimkan prop ke component form untuk mode Edit --}}
                                    <x-admin.cats.form-cats
                                        :id="$item->id"
                                        :user-id="$item->user_id"
                                        :users="$users"
                                        :name="$item->name"
                                        :breed="$item->breed"
                                        :gender="$item->gender"
                                        :age="$item->age"
                                        :color="$item->color"
                                        :health-notes="$item->health_notes"
                                    />

                                    {{-- Tombol Hapus --}}
                                    <a href="{{ route('admin.data-master.cats.destroy', $item->id) }}"
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