<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cats;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CatsController extends Controller
{
    public function index()
    {

        $cats = Cats::with('user')->latest()->get();
        
        $users = User::where('role','user')->latest()->get();

        confirmDelete("Hapus Data Kucing", "Apakah Anda yakin ingin menghapus data kucing ini?");

        
        return view('admin.cats.index', compact('cats', 'users'));
    }

    public function store(Request $request)
    {
        $id = $request->id;

        $request->validate([
            'user_id'      => 'required|exists:users,id',
            'name'         => 'required|string|max:255',
            'breed'        => 'nullable|string|max:255',
            'gender'       => 'nullable|in:Jantan,Betina',
            'age'          => 'nullable|string|max:255',
            'color'        => 'nullable|string|max:255',
            'photo'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'health_notes' => 'nullable|string',
        ], [
            'user_id.required' => 'Pemilik kucing wajib dipilih',
            'user_id.exists'   => 'Pemilik kucing tidak ditemukan di sistem',
            'name.required'    => 'Nama kucing wajib diisi',
            'gender.in'        => 'Jenis kelamin hanya boleh Jantan atau Betina',
            'photo.image'      => 'File upload harus berupa gambar (JPEG, PNG, JPG)',
            'photo.max'        => 'Ukuran foto maksimal adalah 2MB',
        ]);

        $cat = Cats::find($id);
        $photoPath = $cat ? $cat->photo : null;

        if ($request->hasFile('photo')) {

            if ($photoPath && Storage::disk('public')->exists($photoPath)) {
                Storage::disk('public')->delete($photoPath);
            }
            
            $photoPath = $request->file('photo')->store('cats', 'public');
        }

        Cats::updateOrCreate(
            ['id' => $id],
            [
                'user_id'      => $request->user_id,
                'name'         => $request->name,
                'breed'        => $request->breed,
                'gender'       => $request->gender,
                'age'          => $request->age,
                'color'        => $request->color,
                'photo'        => $photoPath,
                'health_notes' => $request->health_notes,
            ]
        );

        toast()->success($id ? 'Data kucing berhasil diperbarui' : 'Data kucing berhasil disimpan');
    
        return redirect()->route('admin.data-master.cats.index');
    }

    public function destroy(string $id)
    {
        $cat = Cats::findOrFail($id);

        if ($cat->photo && Storage::disk('public')->exists($cat->photo)) {
            Storage::disk('public')->delete($cat->photo);
        }

        $cat->delete();

        toast()->success('Data kucing berhasil dihapus');

        return redirect()->route('admin.data-master.cats.index');
    }
}