<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function index()
    {
        $obats = Obat::all(); // hanya yang tidak terhapus

        return view('admin.obat.index')->with([
            'obats' => $obats,
        ]);
    }

    public function create()
    {
        return view('admin.obat.create');
    }

    public function edit($id)
    {
        $obat = Obat::find($id); // atau Obat::withTrashed()->find($id) jika ingin bisa edit yang sudah soft-deleted

        return view('admin.obat.edit')->with([
            'obat' => $obat,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
        ]);

        Obat::create([
            'nama_obat' => $request->nama_obat,
            'kemasan' => $request->kemasan,
            'harga' => $request->harga,
        ]);

        return redirect()->route('admin.obat.index')->with('status', 'obat-created');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
        ]);

        $obat = Obat::find($id);
        $obat->update([
            'nama_obat' => $request->nama_obat,
            'kemasan' => $request->kemasan,
            'harga' => $request->harga,
        ]);

        return redirect()->route('admin.obat.index')->with('status', 'obat-updated');
    }

    public function destroy($id)
    {
        $obat = Obat::find($id);
        $obat->delete(); // soft delete

        return redirect()->route('admin.obat.index')->with('status', 'obat-deleted');
    }

    // Menampilkan daftar obat yang terhapus
    public function trash()
    {
        $obats = Obat::onlyTrashed()->get();

        return view('admin.obat.trash')->with([
            'obats' => $obats,
        ]);
    }

    // Mengembalikan obat yang telah di-soft delete
    public function restore($id)
    {
        $obat = Obat::onlyTrashed()->find($id);
        if ($obat) {
            $obat->restore();
        }

        return redirect()->route('admin.obat.index')->with('status', 'obat-restored');
    }
}
