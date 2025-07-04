<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\JanjiPeriksa;
use App\Models\Obat;
use App\Models\DetailPeriksa;
use Illuminate\Http\Request;

class MemeriksaController extends Controller
{
    public function index()
    {
        $pendaftarans = JanjiPeriksa::with(['pasien', 'periksa'])
            ->whereHas('jadwalPeriksa', function ($query) {
                $query->where('id_dokter', auth()->id());
            })
            ->orderBy('no_antrian')
            ->get();

        return view('dokter.memeriksa.index', compact('pendaftarans'));
    }

    public function periksa($id)
    {
        $pendaftaran = JanjiPeriksa::with(['pasien', 'jadwalPeriksa'])->findOrFail($id);

        if ($pendaftaran->jadwalPeriksa->id_dokter !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke data ini.');
        }

        $obats = Obat::all();
        return view('dokter.memeriksa.edit', compact('pendaftaran', 'obats'));
    }

    public function edit($id)
    {
        $pendaftaran = JanjiPeriksa::with(['pasien', 'periksa', 'jadwalPeriksa'])->findOrFail($id);

        if ($pendaftaran->jadwalPeriksa->id_dokter !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke data ini.');
        }

        $obats = Obat::all();
        return view('dokter.memeriksa.edit', compact('pendaftaran', 'obats'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'tgl_periksa' => 'required|date',
            'catatan' => 'required|string',
            'biaya_periksa' => 'required|numeric',
            'obat' => 'array',
        ]);

        $pendaftaran = JanjiPeriksa::with(['periksa', 'jadwalPeriksa'])->findOrFail($id);

        if ($pendaftaran->jadwalPeriksa->id_dokter !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke data ini.');
        }

        $daftarNamaObat = '';

        if ($request->has('obat')) {
            $obatList = \App\Models\Obat::whereIn('id', $request->obat)->pluck('nama_obat')->toArray();
            $daftarNamaObat = implode("\n", $obatList);
        }

        $periksa = $pendaftaran->periksa()->create([
            'tgl_periksa' => $request->tgl_periksa,
            'catatan' => $request->catatan,
            'biaya_periksa' => $request->biaya_periksa,
            'daftar_obat' => $daftarNamaObat,
        ]);


        if ($request->has('obat')) {
            foreach ($request->obat as $id_obat) {
                DetailPeriksa::create([
                    'id_periksa' => $periksa->id,
                    'id_obat' => $id_obat,
                ]);
            }
        }

        $pendaftaran->update(['status' => 'Sudah diperiksa']);

        return redirect()->route('dokter.memeriksa.index')->with('success', 'Data pemeriksaan berhasil disimpan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tgl_periksa' => 'required|date',
            'catatan' => 'required|string',
            'biaya_periksa' => 'required|numeric',
            'obat' => 'array',
        ]);

        $pendaftaran = JanjiPeriksa::with(['periksa', 'jadwalPeriksa'])->findOrFail($id);

        if ($pendaftaran->jadwalPeriksa->id_dokter !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke data ini.');
        }

        $periksa = $pendaftaran->periksa;

        if (!$periksa) {
            abort(404, 'Data pemeriksaan tidak ditemukan.');
        }

        $periksa->update([
            'tgl_periksa' => $request->tgl_periksa,
            'catatan' => $request->catatan,
            'biaya_periksa' => $request->biaya_periksa,
        ]);

        DetailPeriksa::where('id_periksa', $periksa->id)->delete();

        if ($request->has('obat')) {
            foreach ($request->obat as $id_obat) {
                DetailPeriksa::create([
                    'id_periksa' => $periksa->id,
                    'id_obat' => $id_obat,
                ]);
            }
        }

        return redirect()->route('dokter.memeriksa.index')->with('success', 'Data pemeriksaan berhasil diperbarui.');
    }
}
