<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\JadwalPeriksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class JadwalPeriksaController extends Controller
{
    public function index()
    {
        $jadwalPeriksas = JadwalPeriksa::where('id_dokter', Auth::user()->id)->get();

        return view('dokter.jadwal-periksa.index')->with([
            'jadwalPeriksas' => $jadwalPeriksas,
        ]);
    }

    public function create()
    {
        return view('dokter.jadwal-periksa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat, Sabtu,Minggu',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        // Cek jika dokter sudah memiliki jadwal periksa yang sama
        if(JadwalPeriksa::where('id_dokter', Auth::user()->id)
            ->where('hari', $request->hari)
            ->where('jam_mulai', $request->jam_mulai)
            ->where('jam_selesai', $request->jam_selesai)
            ->exists()) {
            return redirect()->route('dokter.jadwal-periksa.index')->with('status', 'jadwal-periksa-exists');
        }

        JadwalPeriksa::create([
            'id_dokter' => Auth::user()->id,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status' => false,
        ]);

        return redirect()->route('dokter.jadwal-periksa.index')->with('status', 'jadwal-periksa-created');
    }

public function update(Request $request, $id)
{
    $request->validate([
        'hari' => 'required',
        'jam_mulai' => 'required',
        'jam_selesai' => 'required|after:jam_mulai',
    ]);

    $jadwal = JadwalPeriksa::where('id', $id)
        ->where('id_dokter', Auth::id())
        ->firstOrFail();

    $jadwal->update([
        'hari' => $request->hari,
        'jam_mulai' => $request->jam_mulai,
        'jam_selesai' => $request->jam_selesai,
    ]);

    // Akan kembali ke halaman index jadwal dokter
    return redirect()->route('dokter.jadwal-periksa.index')->with('success', 'Jadwal berhasil diperbarui.');
}

    public function edit($id)
{
    $jadwal = JadwalPeriksa::where('id', $id)
        ->where('id_dokter', Auth::id())
        ->firstOrFail();

    return view('dokter.jadwal-periksa.edit', compact('jadwal'));
}

}
