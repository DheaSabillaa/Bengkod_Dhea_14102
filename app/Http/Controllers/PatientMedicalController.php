<?php
namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use Illuminate\Http\Request;

class PatientMedicalController extends Controller
{
    public function create()
    {
        return view('pasien.periksa');
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_name' => 'required|string|max:255',
            'medical_note' => 'required|string',
            'appointment_date' => 'required|date|after_or_equal:today',
        ]);

        try {
            $record = MedicalRecord::create([
                'patient_name' => $request->patient_name,
                'medical_note' => $request->medical_note,
                'appointment_date' => $request->appointment_date,
                'user_id' => auth()->id(),
                'status' => 'pending',
                // Kolom medicine_cost dan total_cost akan menggunakan default value 0.00
            ]);

            \Log::info('Medical Record Created: ', $record->toArray());

            return redirect()->route('pasien.riwayat')->with('success', 'Janji pemeriksaan berhasil dibuat.');
        } catch (\Exception $e) {
            \Log::error('Error creating medical record: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal membuat janji pemeriksaan: ' . $e->getMessage());
        }
    }

    public function history()
    {
        try {
            $userId = auth()->id();
            if (!$userId) {
                \Log::error('User not authenticated in history method');
                return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
            }

            $records = MedicalRecord::where('user_id', $userId)->get();
            \Log::info('User ID: ' . $userId);
            \Log::info('Medical Records Retrieved: ', $records->toArray());

            return view('pasien.riwayat', compact('records'));
        } catch (\Exception $e) {
            \Log::error('Error retrieving medical records: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal mengambil data riwayat: ' . $e->getMessage());
        }
    }
}