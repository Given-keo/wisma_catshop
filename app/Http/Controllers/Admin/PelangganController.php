<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PelangganController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->latest()->get();

        confirmDelete(
            "Hapus Pelanggan",
            "Apakah Anda yakin ingin menghapus data pelanggan ini? Semua data kucing dan transaksi terkait juga akan terhapus."
        );

        return view('admin.users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $id = $request->id;

        $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|max:255|unique:users,email,' . $id,
            'whatsapp'       => 'required|string|max:20|unique:users,whatsapp,' . $id,
            'password'       => $id ? 'nullable|min:8' : 'required|min:8',
            'address'        => 'nullable|string',
            'loyalty_points' => 'nullable|numeric|min:0',
        ], [
            'name.required'            => 'Nama pelanggan wajib diisi',
            'email.required'           => 'Email wajib diisi',
            'email.email'              => 'Format email tidak valid',
            'email.unique'             => 'Email ini sudah terdaftar',
            'whatsapp.required'        => 'Nomor WhatsApp wajib diisi',
            'whatsapp.unique'          => 'Nomor WhatsApp ini sudah terdaftar',
            'password.required'        => 'Password wajib diisi untuk pengguna baru',
            'password.min'             => 'Password minimal 8 karakter',
            'loyalty_points.numeric'   => 'Poin loyalitas harus berupa angka',
        ]);

        $data = [
            'name'           => $request->name,
            'email'          => $request->email,
            'whatsapp'       => $request->whatsapp,
            'address'        => $request->address,
            'role'           => 'user',
            'loyalty_points' => $request->loyalty_points ?? 0,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        User::updateOrCreate(
            ['id' => $id],
            $data
        );

        toast()->success(
            $id
                ? 'Data pelanggan berhasil diperbarui'
                : 'Data pelanggan berhasil disimpan'
        );

        return redirect()->route('admin.data-master.users.index');
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        toast()->success('Data pelanggan berhasil dihapus');

        return redirect()->route('admin.data-master.users.index');
    }
}