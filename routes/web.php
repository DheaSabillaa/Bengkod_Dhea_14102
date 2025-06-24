<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\PatientMedicalController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('landing_page');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/register', [AuthController::class, 'showRegsiterForm']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
// Route Auth
Route::get('/register', [AuthController::class, 'showRegsiterForm'])->name('register');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Route Dokter
Route::get('/dokter/dashboard', function () {
    return view('dokter.index');
})->name('dokter.dashboard')->middleware('role:dokter', 'auth');

Route::get('/dokter/obat', [ObatController::class, 'index'])->middleware('role:dokter', 'auth');
Route::get('/dokter/obat/create', [ObatController::class, 'create'])->middleware('role:dokter', 'auth');
Route::post('/dokter/obat', [ObatController::class, 'store'])->middleware('role:dokter', 'auth');
Route::get('/dokter/obat/{id}/edit', [ObatController::class, 'edit'])->middleware('role:dokter', 'auth');
Route::put('/dokter/obat/{id}', [ObatController::class, 'update'])->middleware('role:dokter', 'auth');
Route::delete('/dokter/obat/{id}', [ObatController::class, 'destroy'])->middleware('role:dokter', 'auth');

// Route untuk Memeriksa (Dokter)
Route::get('/dokter/memeriksa', [MedicalRecordController::class, 'index'])->name('dokter.memeriksa.index')->middleware('role:dokter', 'auth');
Route::get('/dokter/tambah-pemeriksaan', [MedicalRecordController::class, 'create'])->name('dokter.tambah.pemeriksaan')->middleware('role:dokter', 'auth');
Route::post('/dokter/memeriksa', [MedicalRecordController::class, 'store'])->name('dokter.memeriksa.store')->middleware('role:dokter', 'auth');

// Route Pasien
Route::get('/pasien/dashboard', function () {
    return view('pasien.index');
})->name('pasien.dashboard')->middleware('role:pasien', 'auth');

Route::get('/pasien/periksa', [PatientMedicalController::class, 'create'])->name('pasien.periksa')->middleware('role:pasien', 'auth');
Route::post('/pasien/periksa', [PatientMedicalController::class, 'store'])->name('pasien.periksa.store')->middleware('role:pasien', 'auth');
Route::get('/pasien/riwayat', [PatientMedicalController::class, 'history'])->name('pasien.riwayat')->middleware('role:pasien', 'auth');
