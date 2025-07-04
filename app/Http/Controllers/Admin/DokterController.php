<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Poli;
use Illuminate\Support\Facades\Hash;

class DokterController extends Controller
{
    public function daftarDokter()
    {
        $dokters = User::where('role', 'dokter')->with('poli')->get();
        $poli = Poli::all();
        return view('admin.dokter.index', compact('dokters', 'poli'));
    }

    public function createDokter()
    {
        $poli = Poli::all();
        return view('admin.dokter.create', compact('poli'));
    }

    public function storeDokter(Request $request)
    {
        $validated = $request->validate([
            'nama'     => 'required',
            'alamat'   => 'required',
            'no_hp'    => 'required',
            'no_ktp'   => 'required|digits:10|unique:users,no_ktp',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8',
           'poli'    => 'required|string', // gunakan id_poli sesuai struktur tabel
        ]);

        User::create([
            'nama'     => $validated['nama'],
            'alamat'   => $validated['alamat'],
            'no_hp'    => $validated['no_hp'],
            'no_ktp'   => $validated['no_ktp'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'poli'  => $validated['poli'],
            'role'     => 'dokter',
        ]);

        return redirect()->route('admin.dokter.index')->with('success', 'Dokter berhasil ditambahkan');
    }

    public function editDokter($id)
{
    $dokter = User::findOrFail($id); // ← variabel tunggal
    $poli = Poli::all();
    return view('admin.dokter.edit', compact('dokter', 'poli'));
}


    public function updateDokter(Request $request, $id)
    {
        $dokter = User::findOrFail($id);

        $validated = $request->validate([
            'nama'     => 'required',
            'alamat'   => 'required',
            'no_hp'    => 'required',
            'no_ktp'   => 'required|digits:10|unique:users,no_ktp,' . $id,
            'email'    => 'required|email|unique:users,email,' . $id,
            'poli'  => 'string',
        ]);

        // Tambahkan update password jika diisi
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        }

        $dokter->update($validated);

        return redirect()->route('admin.dokter.index')->with('success', 'Data dokter diperbarui');
    }
}



