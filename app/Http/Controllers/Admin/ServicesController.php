<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index()
    {

        $services = Service::latest()->get();
        

        confirmDelete("Hapus Layanan", "Apakah Anda yakin ingin menghapus data layanan ini?");
        

        return view('admin.services.index', compact('services'));
    }

    public function store(Request $request)
    {
        $id = $request->id;

        $request->validate([
            'name'        => 'required|string|max:255',
            'type'        => 'required|in:grooming,boarding',
            'price'       => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ], [
            'name.required'  => 'Nama layanan wajib diisi',
            'type.required'  => 'Tipe layanan wajib dipilih',
            'type.in'        => 'Tipe layanan hanya boleh grooming atau boarding',
            'price.required' => 'Harga layanan wajib diisi',
            'price.numeric'  => 'Harga layanan harus berupa angka',
        ]);

        Service::updateOrCreate(
            ['id' => $id],
            [
                'name'        => $request->name,
                'type'        => $request->type,
                'price'       => $request->price,
                'description' => $request->description,
                'is_active'   => $request->has('is_active') ? true : false, 
            ]
        );

        toast()->success($id ? 'Data layanan berhasil diperbarui' : 'Data layanan berhasil disimpan');
        
    
        return redirect()->route('admin.data-master.services.index');
    }

    public function destroy(string $id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        toast()->success('Data layanan berhasil dihapus');
        

        return redirect()->route('admin.data-master.services.index');
    }
}