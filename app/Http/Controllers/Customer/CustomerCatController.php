<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cats; // Pastikan nama model sesuai (Cats atau Cat)
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CustomerCatController extends Controller
{
    /**
     * Menampilkan daftar kucing milik pelanggan yang sedang login.
     */
    public function index()
    {
        // Hanya ambil kucing milik user yang sedang login
        $cats = Cats::where('user_id', Auth::id())->latest()->get();

        return view('customer.cats.index', compact('cats'));
    }

    /**
     * Menampilkan form tambah data kucing.
     */
    public function create()
    {
        return view('customer.cats.create');
    }

    /**
     * Menyimpan data kucing baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'breed' => 'nullable|string|max:255',
            'gender' => 'required|in:Jantan,Betina',
            'age' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 
            'health_notes' => 'nullable|string',
        ]);

        $data = $request->except('photo');
        

        $data['user_id'] = Auth::id(); 

    
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('cats', 'public');
        }

        Cats::create($data);

        return redirect()->route('customer.cats.index')
            ->with('success', 'Data kucing kesayanganmu berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit data kucing.
     */
    public function edit($id)
    {
        // firstOrFail memastikan jika kucing bukan milik user ini, akan muncul error 404
        $cat = Cats::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        return view('customer.cats.edit', compact('cat'));
    }

    /**
     * Memperbarui data kucing.
     */
    public function update(Request $request, $id)
    {
        $cat = Cats::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'breed' => 'nullable|string|max:255',
            'gender' => 'required|in:Jantan,Betina',
            'age' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'health_notes' => 'nullable|string',
        ]);

        $data = $request->except('photo');

        // Proses ganti foto jika ada upload foto baru
        if ($request->hasFile('photo')) {
            // Hapus foto lama dari storage agar tidak memenuhi memori server
            if ($cat->photo && Storage::disk('public')->exists($cat->photo)) {
                Storage::disk('public')->delete($cat->photo);
            }
            $data['photo'] = $request->file('photo')->store('cats', 'public');
        }

        $cat->update($data);

        return redirect()->route('customer.cats.index')
            ->with('success', 'Data kucing berhasil diperbarui!');
    }

    /**
     * Menghapus data kucing.
     */
    public function destroy($id)
    {
        $cat = Cats::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        // Opsional & Rekomendasi: Anda bisa menambahkan validasi di sini
        // untuk mencegah user menghapus kucing jika kucing tersebut sedang dalam proses booking/dititip.

        // Hapus foto fisik dari storage sebelum menghapus data di database
        if ($cat->photo && Storage::disk('public')->exists($cat->photo)) {
            Storage::disk('public')->delete($cat->photo);
        }

        $cat->delete();

        return redirect()->route('customer.cats.index')
            ->with('success', 'Data kucing berhasil dihapus.');
    }
}