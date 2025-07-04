<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ====== LOGIN & REGISTER ======

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'nama'     => 'required|max:255',
            'alamat'   => 'required|max:255',
            'no_hp'    => 'required|max:20',
            'no_ktp'   => 'required|digits:10|unique:users,no_ktp',
            'email'    => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:8',
        ]);

        try {
            User::create([
                'nama'     => $validatedData['nama'],
                'alamat'   => $validatedData['alamat'],
                'no_hp'    => $validatedData['no_hp'],
                'no_ktp'   => $validatedData['no_ktp'],
                'email'    => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'role'     => 'pasien',
            ]);

            toastr()->success('Registrasi berhasil. Silakan login.');
            return redirect()->route('login');

        } catch (\Exception $e) {
            toastr()->error('Gagal menyimpan data: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            toastr()->success('Selamat datang, ' . $user->nama);

            return match ($user->role) {
                'admin'  => redirect('/admin/dashboard'),
                'dokter' => redirect('/dokter/dashboard'),
                'pasien' => redirect('/pasien/dashboard'),
                default  => abort(403),
            };
        }

        toastr()->error('Email atau password salah');
        return back()->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        toastr()->success('Anda berhasil logout');
        return redirect('/login');
    }

}
