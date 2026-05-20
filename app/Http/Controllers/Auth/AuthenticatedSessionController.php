<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        try {

            $request->authenticate();

            $request->session()->regenerate();

            Alert::success(
                'Berhasil Login',
                'Selamat Datang Kembali!'
            );

            // Jika role admin
            if ($request->user()->role === 'admin') {

                return redirect()->intended(
                    route('admin.dashboard', absolute: false)
                );
            }

            // Jika user biasa
            return redirect()->intended(
                route('customer.dashboard', absolute: false)
            );

        } catch (ValidationException $e) {

            Alert::error(
                'Login Gagal',
                'Email atau password salah!'
            );

            return back()
                ->withErrors([
                    'email' => 'Email atau password salah.'
                ])
                ->onlyInput('email');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        Alert::success(
            'Berhasil Logout',
            'Anda telah keluar dari akun.'
        );

        return redirect('/');
    }
}