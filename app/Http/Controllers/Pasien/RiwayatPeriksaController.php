<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\JanjiPeriksa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RiwayatPeriksaController extends Controller
{
public function index()
    {
        // Ambil semua user yang berperan sebagai pasien
        $pasiens = User::where('role', 'pasien')->get();

        return view('dokter.riwayat-periksa.index', [
            'pasiens' => $pasiens,
        ]);
    }

    /**
     * Menampilkan riwayat pemeriksaan untuk satu pasien berdasarkan ID.
     */
    public function detail($id)
    {
        // Ambil janji periksa + relasi jadwal, dokter, poli, dan hasil pemeriksaan
        $pendaftarans = JanjiPeriksa::with(['jadwalPeriksa.dokter', 'poli', 'periksa'])
            ->where('id_pasien', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Ambil info pasien
        $pasien = User::findOrFail($id);

        return view('dokter.riwayat-periksa.detail', [
            'pasien' => $pasien,
            'pendaftarans' => $pendaftarans,
        ]);
    }

}
