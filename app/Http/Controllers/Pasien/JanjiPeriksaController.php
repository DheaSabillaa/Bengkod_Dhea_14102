<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\Poli;
use App\Models\JadwalPeriksa;
use App\Models\JanjiPeriksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class JanjiPeriksaController extends Controller
{
    public function index()
    {
        $poli = Poli::all();
        $jadwal = JadwalPeriksa::with('dokter')->orderBy('hari')->get();

        // Filter hanya data milik pasien yang login
        $pendaftarans = JanjiPeriksa::with(['poli', 'jadwalPeriksa.dokter'])
            ->where('id_pasien', Auth::id())
            ->latest()->get();

        // Generate no_rm
        $now = Carbon::now();
        $tahunBulan = $now->format('Ym');
        $jumlahPasienBulanIni = JanjiPeriksa::whereYear('created_at', $now->year)
            ->whereMonth('created_at', $now->month)
            ->count();
        $noUrut = str_pad($jumlahPasienBulanIni + 1, 3, '0', STR_PAD_LEFT);
        $no_rm = $tahunBulan . '-' . $noUrut;

        return view('pasien.poli.index', compact('poli', 'jadwal', 'pendaftarans', 'no_rm'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_poli' => 'required|exists:polis,id',
            'id_jadwal_periksa' => 'required|exists:jadwal_periksas,id',
            'keluhan' => 'required|string',
            'status' => 'required|in:Belum diperiksa,Sudah diperiksa',
            'no_antrian' => 'nullable|numeric|min:1|max:999',
        ]);

        try {
            $now = Carbon::now();
            $tahunBulan = $now->format('Ym');
            $jumlahPasienBulanIni = JanjiPeriksa::whereYear('created_at', $now->year)
                ->whereMonth('created_at', $now->month)
                ->count();
            $noUrut = str_pad($jumlahPasienBulanIni + 1, 3, '0', STR_PAD_LEFT);
            $no_rm = $tahunBulan . '-' . $noUrut;
            $no_antrian = (int)substr($noUrut, -3);

            // Ambil jadwal tanpa relasi poli
            $jadwal = JadwalPeriksa::findOrFail($request->id_jadwal_periksa);

            // Ambil id_pasien dari pengguna yang login
            $id_pasien = Auth::id();
            if (!$id_pasien) {
                Log::error('Pengguna belum login');
                return back()->withErrors(['auth' => 'Pasien belum login.']);
            }

            // Simpan data ke DB
            $janji = JanjiPeriksa::create([
                'no_rm' => $no_rm,
                'id_pasien' => $id_pasien,
                'id_jadwal_periksa' => $jadwal->id,
                'id_poli' => $request->id_poli,
                'keluhan' => $request->keluhan,
                'no_antrian' => $no_antrian,
                'status' => $request->status,
            ]);

            // Logging berhasil
            Log::info('Janji Periksa berhasil disimpan:', $janji->toArray());

            return redirect()->route('pasien.poli.index')->with('success', 'Berhasil daftar poli.');
        } catch (\Exception $e) {
            // Logging jika gagal
            Log::error('Gagal menyimpan Janji Periksa: ' . $e->getMessage());
            return back()->withErrors(['gagal' => 'Gagal mendaftar poli. Silakan coba lagi.']);
        }
    }

    public function detail($id)
    {
        $pendaftaran = JanjiPeriksa::with(['poli', 'jadwalPeriksa.dokter'])->findOrFail($id);
        return view('pasien.poli.detail', compact('pendaftaran'));
    }

    public function riwayat($id)
    {
        $pendaftaran = JanjiPeriksa::with(['poli', 'jadwalPeriksa.dokter'])->findOrFail($id);
        return view('pasien.poli.riwayat', compact('pendaftaran'));
    }
}
