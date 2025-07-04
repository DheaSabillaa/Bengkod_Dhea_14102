<?php
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dokter\JadwalPeriksaController;
use App\Http\Controllers\Dokter\ProfilController;
use App\Http\Controllers\Pasien\JanjiPeriksaController;
use App\Http\Controllers\Dokter\MemeriksaController;
use App\Http\Controllers\Pasien\RiwayatPeriksaController;
use App\Http\Controllers\Admin\DokterController;
use App\Http\Controllers\Admin\PasienController;
use App\Http\Controllers\Admin\PoliController;
use App\Http\Controllers\Dokter\ObatController;




Route::get('/', function () {
    return view('landing_page');
});


// Halaman Register
Route::get('/register', [AuthController::class, 'showRegisterForm']);
Route::post('/register', [AuthController::class, 'register']);

// Login untuk semua
Route::get('/login', [AuthController::class, 'showLoginForm']);
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Login berdasarkan role (optional, pakai form yang sama)
Route::get('/login-dokter', [AuthController::class, 'showLoginForm']);
Route::get('/login-pasien', [AuthController::class, 'showLoginForm']);

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// (Opsional) Dashboard
Route::get('/dokter/dashboard', fn () => 'Halaman Dashboard Dokter')->middleware('auth');
Route::get('/pasien/dashboard', fn () => 'Halaman Dashboard Pasien')->middleware('auth');


Route::middleware(['auth', 'role:dokter'])->group(function () {
    Route::get('/dokter/profil', [ProfilController::class, 'edit'])->name('dokter.profil');
    Route::put('/dokter/profil', [ProfilController::class, 'update'])->name('dokter.profil.update');
});


// Route Dokter
Route::get('/dokter/dashboard', function () {
    return view('dokter.index');
})->name('dokter.dashboard')->middleware('role:dokter', 'auth');

// Route Pasien
Route::get('/pasien/dashboard', function () {
    return view('pasien.index');
})->name('pasien.dashboard')->middleware('role:pasien', 'auth');


// Route Pasien
Route::get('/admin/dashboard', function () {
    return view('admin.index');
})->name('admin.dashboard')->middleware('role:admin', 'auth');


Route::prefix('admin/dokter')->name('admin.dokter.')->middleware('auth')->group(function () {
    Route::get('/', [DokterController::class, 'daftarDokter'])->name('index');
    Route::get('/create', [DokterController::class, 'createDokter'])->name('create');
    Route::post('/', [DokterController::class, 'storeDokter'])->name('store');
    Route::get('/{id}/edit', [DokterController::class, 'editDokter'])->name('edit');
    Route::put('/{id}', [DokterController::class, 'updateDokter'])->name('update');
    Route::delete('/{id}', [DokterController::class, 'destroyDokter'])->name('destroy');
});


Route::prefix('admin/pasien')->name('admin.pasien.')->middleware('auth')->group(function () {
    Route::get('/', [PasienController::class, 'daftarPasien'])->name('index');
    Route::get('/create', [PasienController::class, 'createPasien'])->name('create');
    Route::post('/', [PasienController::class, 'storePasien'])->name('store');
    Route::get('/{id}/edit', [PasienController::class, 'editPasien'])->name('edit');
    Route::put('/{id}', [PasienController::class, 'updatePasien'])->name('update');
    Route::delete('/{id}', [PasienController::class, 'destroyPasien'])->name('destroy');
});


Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/poli', [PoliController::class, 'index'])->name('poli.index');
    Route::post('/poli', [PoliController::class, 'store'])->name('poli.store');
    Route::get('/poli/{id}/edit', [PoliController::class, 'edit'])->name('poli.edit');
    Route::put('/poli/{id}', [PoliController::class, 'update'])->name('poli.update');
    Route::delete('/poli/{id}', [PoliController::class, 'destroy'])->name('poli.destroy');
});

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::resource('obat', ObatController::class)->except(['show', 'create']);
});


Route::prefix('dokter')->name('dokter.')->middleware('auth')->group(function () {
    Route::resource('jadwal-periksa', JadwalPeriksaController::class)
        ->names([
            'index'   => 'jadwal-periksa.index',
            'create'  => 'jadwal-periksa.create',
            'store'   => 'jadwal-periksa.store',
            'edit'    => 'jadwal-periksa.edit',
            'update'  => 'jadwal-periksa.update',
            'destroy' => 'jadwal-periksa.destroy',
        ]);
});

Route::prefix('dokter/jadwal-periksa')->name('dokter.jadwal-periksa.')->middleware(['auth', 'role:dokter'])->group(function () {
    Route::get('/', [JadwalPeriksaController::class, 'index'])->name('index');
    Route::get('/create', [JadwalPeriksaController::class, 'create'])->name('create');
    Route::post('/', [JadwalPeriksaController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [JadwalPeriksaController::class, 'edit'])->name('edit'); // ini penting
    Route::put('/{id}', [JadwalPeriksaController::class, 'update'])->name('update');
    Route::put('/{id}/toggle-status', [JadwalPeriksaController::class, 'toggleStatus'])->name('toggleStatus');
    Route::delete('/{id}', [JadwalPeriksaController::class, 'destroy'])->name('destroy');
});

// Route::middleware(['auth', 'role:dokter'])->prefix('dokter')->name('dokter.')->group(function () {
//     Route::get('/memeriksa', [\App\Http\Controllers\Dokter\MemeriksaController::class, 'index'])->name('memeriksa.index');
//     Route::get('/memeriksa/{id}/periksa', [\App\Http\Controllers\Dokter\MemeriksaController::class, 'periksa'])->name('memeriksa.periksa');
//     Route::post('/memeriksa/{id}/periksa', [\App\Http\Controllers\Dokter\MemeriksaController::class, 'store'])->name('memeriksa.store');
//     Route::get('/memeriksa/{id}/edit', [\App\Http\Controllers\Dokter\MemeriksaController::class, 'edit'])->name('memeriksa.edit');
//     Route::put('/memeriksa/{id}/edit', [\App\Http\Controllers\Dokter\MemeriksaController::class, 'update'])->name('memeriksa.update');
// });

// Route::prefix('dokter')->name('dokter.')->middleware('auth')->group(function () {
//     Route::resource('memeriksa', MemeriksaController::class)->except(['create', 'show', 'destroy','store', 'update']);
// });

Route::prefix('dokter')->middleware(['auth'])->group(function () {
    Route::get('/memeriksa', [MemeriksaController::class, 'index'])->name('dokter.memeriksa.index');
    Route::get('/memeriksa/{id}/edit', [MemeriksaController::class, 'edit'])->name('dokter.memeriksa.edit');
    Route::post('/memeriksa/{id}/store', [MemeriksaController::class, 'store'])->name('dokter.memeriksa.store');
    Route::put('/memeriksa/{id}/update', [MemeriksaController::class, 'update'])->name('dokter.memeriksa.update');
});


Route::prefix('dokter')->name('dokter.')->middleware(['auth', 'role:dokter'])->group(function () {
    Route::get('/riwayat-periksa', [RiwayatPeriksaController::class, 'index'])->name('riwayat-periksa.index');
    Route::get('/riwayat-periksa/{id}', [RiwayatPeriksaController::class, 'detail'])->name('riwayat-periksa.detail');
});

Route::get('/pasien/poli', [JanjiPeriksaController::class, 'index'])->name('pasien.poli.index');
Route::get('/pasien/poli/{id}/detail', [JanjiPeriksaController::class, 'detail'])->name('pasien.poli.detail');
Route::get('/pasien/poli/{id}/riwayat', [JanjiPeriksaController::class, 'riwayat'])->name('pasien.poli.riwayat');
Route::post('/pasien/poli', [JanjiPeriksaController::class, 'store'])->name('pasien.poli.store');

Route::middleware(['auth'])->prefix('pasien')->name('pasien.')->group(function () {
    Route::get('/poli', [JanjiPeriksaController::class, 'index'])->name('poli.index');
    Route::post('/poli', [JanjiPeriksaController::class, 'store'])->name('poli.store');
    Route::get('/poli/detail/{id}', [JanjiPeriksaController::class, 'detail'])->name('poli.detail');
    Route::get('/poli/riwayat/{id}', [JanjiPeriksaController::class, 'riwayat'])->name('poli.riwayat');
});



