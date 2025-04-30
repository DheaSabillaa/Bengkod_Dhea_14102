<?php
namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    public function index()
    {
        $records = MedicalRecord::all();
        return view('dokter.memeriksa', compact('records'));
    }

    public function create()
    {
        return view('dokter.tambah_pemeriksaan_pasien');
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_name' => 'required|string|max:255',
            'medical_note' => 'required|string',
            'medicine_cost' => 'required|integer|min:0',
        ]);

        $static_cost = 150000;
        $total_cost = $static_cost + $request->medicine_cost;

        MedicalRecord::create([
            'patient_name' => $request->patient_name,
            'medical_note' => $request->medical_note,
            'medicine_cost' => $request->medicine_cost,
            'total_cost' => $total_cost,
        ]);

        return redirect()->route('dokter.memeriksa.index')->with('success', 'Pemeriksaan berhasil disimpan.');
    }
}