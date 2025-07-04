<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Poli;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    // Tampilkan daftar semua poli
    public function index()
    {
        $polis = Poli::all();
        return view('admin.poli.index', compact('polis'));
    }

    // Simpan poli baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_poli' => 'required|string|max:255',
            'keterangan' => 'nullable|string|max:255',
        ]);

        Poli::create([
            'nama_poli' => $request->nama_poli,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('admin.poli.index')->with('success', 'Poli berhasil ditambahkan.');
    }

    // Tampilkan form edit
   public function edit($id)
{
    $poli = Poli::findOrFail($id); // ✅ Ambil data berdasarkan ID
    return view('admin.poli.edit', compact('poli'));
}

    // Proses update poli
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_poli' => 'required|string|max:255',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $poli = Poli::findOrFail($id);
        $poli->update([
            'nama_poli' => $request->nama_poli,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('admin.poli.index')->with('success', 'Poli berhasil diperbarui.');
    }

    // Hapus poli
    public function destroy($id)
    {
        $poli = Poli::findOrFail($id);
        $poli->delete();

        return redirect()->route('admin.poli.index')->with('success', 'Poli berhasil dihapus.');
    }
}
