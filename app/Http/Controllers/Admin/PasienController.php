<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PasienController extends Controller
{
  // ====== DATA PASIEN ======

public function daftarPasien()
{
    $pasiens = User::where('role', 'pasien')
                ->with(['janjiPeriksas' => function ($query) {
                    $query->select('id_pasien', 'no_rm');
                }])
                ->get();
                $pasienEdit = null;

  return view('admin.pasien.index', compact('pasiens', 'pasienEdit'));

}

public function createPasien()
{
    return view('admin.pasien.form');
}

public function storePasien(Request $request)
{
    $validated = $request->validate([
        'nama'     => 'required',
        'alamat'   => 'required',
        'no_hp'    => 'required',
        'no_ktp'   => 'required|digits:10|unique:users,no_ktp',
        'email'    => 'required|email|unique:users,email',
        'password' => 'required|min:8',
    ]);

    User::create([
        ...$validated,
        'password' => Hash::make($validated['password']),
        'role'     => 'pasien',
    ]);

    return redirect()->route('admin.pasien.index')->with('success', 'Pasien berhasil ditambahkan');
}

public function editPasien($id)
{
    $pasiens = User::where('role', 'pasien')
                ->with(['janjiPeriksas' => function ($query) {
                    $query->select('id_pasien', 'no_rm');
                }])
                ->get();

    $pasienEdit = User::with('janjiPeriksas')->findOrFail($id);

    return view('admin.pasien.index', compact('pasiens', 'pasienEdit'));
}


public function updatePasien(Request $request, $id)
{
    $pasien = User::findOrFail($id);

    $validated = $request->validate([
        'nama'   => 'required',
        'alamat' => 'required',
        'no_hp'  => 'required',
        'no_ktp' => 'required|digits:10|unique:users,no_ktp,' . $id,
        'email'  => 'required|email|unique:users,email,' . $id,
    ]);

    $pasien->update($validated);

    return redirect()->route('admin.pasien.index')->with('success', 'Data pasien diperbarui');
}

public function destroyPasien($id)
{
    User::destroy($id);
    return redirect()->route('admin.pasien.index')->with('success', 'Pasien dihapus');
}

}
