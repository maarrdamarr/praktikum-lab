<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PraktikanController;
use App\Http\Controllers\AsistenController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DosenController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/screenshot/{role}/{view?}', function ($role, $view = 'dashboard') {
    $user = new \App\Models\User();
    $user->name = 'Budi (' . ucfirst($role) . ')';
    $user->role = $role;
    \Illuminate\Support\Facades\Auth::setUser($user);
    
    if ($view === 'dashboard') {
        return view('dashboard');
    }
    
    $viewPath = $role . '.' . $view;
    if (view()->exists($viewPath)) {
        return view($viewPath);
    }
    
    return "View $viewPath not found";
});

// Redirect /dashboard based on role
Route::get('/dashboard', function () {
    $role = auth()->user()->role;
    return redirect()->route($role . '.dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/absensi', [DashboardController::class, 'absensi'])->middleware(['auth'])->name('absensi');
Route::post('/absensi', [DashboardController::class, 'storeAbsensi'])->middleware(['auth'])->name('absensi.store');

Route::get('/profile', [DashboardController::class, 'profile'])->middleware(['auth'])->name('profile');
Route::post('/profile', [DashboardController::class, 'updateProfile'])->middleware(['auth'])->name('profile.update');

Route::middleware(['auth'])->group(function () {

    // Role Praktikan
    Route::middleware(['role:praktikan'])->prefix('praktikan')->name('praktikan.')->group(function () {
        Route::get('/dashboard', [PraktikanController::class, 'index'])->name('dashboard');
        Route::get('/pendaftaran', [PraktikanController::class, 'pendaftaran'])->name('pendaftaran');
        Route::post('/pendaftaran', [PraktikanController::class, 'storePendaftaran'])->name('pendaftaran.store');
        Route::get('/pilih-jadwal', [PraktikanController::class, 'pilihJadwal'])->name('pilih-jadwal');
        Route::post('/pilih-jadwal', [PraktikanController::class, 'storeJadwal'])->name('pilih-jadwal.store');
        Route::get('/pre-test', [PraktikanController::class, 'preTest'])->name('pre-test');
        Route::post('/pre-test', [PraktikanController::class, 'storePreTest'])->name('pre-test.store');
        Route::get('/upload-laporan', [PraktikanController::class, 'uploadLaporan'])->name('upload-laporan');
        Route::post('/upload-laporan', [PraktikanController::class, 'storeLaporan'])->name('upload-laporan.store');
        Route::get('/lihat-nilai', [PraktikanController::class, 'lihatNilai'])->name('lihat-nilai');
        Route::get('/presensi-qr', [PraktikanController::class, 'presensiQR'])->name('presensi-qr');
    });

    // Role Asisten
    Route::middleware(['role:asisten'])->prefix('asisten')->name('asisten.')->group(function () {
        Route::get('/dashboard', [AsistenController::class, 'index'])->name('dashboard');
        Route::get('/validasi-presensi', [AsistenController::class, 'validasiPresensi'])->name('validasi-presensi');
        Route::post('/validasi-presensi', [AsistenController::class, 'storeValidasi'])->name('validasi-presensi.store');
        Route::get('/nilai-pre-test', [AsistenController::class, 'nilaiPreTest'])->name('nilai-pre-test');
        Route::post('/nilai-pre-test', [AsistenController::class, 'storeNilaiPreTest'])->name('nilai-pre-test.store');
        Route::get('/review-laporan', [AsistenController::class, 'reviewLaporan'])->name('review-laporan');
        Route::post('/review-laporan', [AsistenController::class, 'storeReview'])->name('review-laporan.store');
        Route::get('/input-nilai', [AsistenController::class, 'inputNilai'])->name('input-nilai');
        Route::post('/input-nilai', [AsistenController::class, 'storeNilaiAktivitas'])->name('input-nilai.store');
        Route::get('/monitoring-kelompok', [AsistenController::class, 'monitoringKelompok'])->name('monitoring-kelompok');
    });

    // Role Admin (Laboran)
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::get('/kelola-jadwal', [AdminController::class, 'kelolaJadwal'])->name('kelola-jadwal');
        Route::post('/kelola-jadwal', [AdminController::class, 'storeJadwal'])->name('kelola-jadwal.store');
        Route::get('/kelola-pengguna', [AdminController::class, 'kelolaPengguna'])->name('kelola-pengguna');
        Route::post('/kelola-pengguna', [AdminController::class, 'storePengguna'])->name('kelola-pengguna.store');
        Route::post('/kelola-pengguna/import', [AdminController::class, 'importPengguna'])->name('kelola-pengguna.import');
        Route::get('/kelola-pengguna/export', [AdminController::class, 'exportPengguna'])->name('kelola-pengguna.export');
        Route::get('/alokasi-asisten', [AdminController::class, 'alokasiAsisten'])->name('alokasi-asisten');
        Route::post('/alokasi-asisten', [AdminController::class, 'storeAlokasi'])->name('alokasi-asisten.store');
        Route::get('/distribusi-modul', [AdminController::class, 'distribusiModul'])->name('distribusi-modul');
        Route::post('/distribusi-modul', [AdminController::class, 'storeModul'])->name('distribusi-modul.store');
        Route::get('/kelola-ruangan', [AdminController::class, 'kelolaRuangan'])->name('kelola-ruangan');
        Route::post('/kelola-ruangan', [AdminController::class, 'storeRuangan'])->name('kelola-ruangan.store');
        Route::get('/deteksi-clash', [AdminController::class, 'deteksiClash'])->name('deteksi-clash');
    });

    // Role Dosen
    Route::middleware(['role:dosen'])->prefix('dosen')->name('dosen.')->group(function () {
        Route::get('/dashboard', [DosenController::class, 'index'])->name('dashboard');
        Route::get('/buat-soal', [DosenController::class, 'buatSoal'])->name('buat-soal');
        Route::post('/buat-soal', [DosenController::class, 'storeSoal'])->name('buat-soal.store');
        Route::put('/buat-soal/{id}', [DosenController::class, 'updateSoal'])->name('buat-soal.update');
        Route::delete('/buat-soal/{id}', [DosenController::class, 'destroySoal'])->name('buat-soal.delete');
        Route::post('/buat-soal/import', [DosenController::class, 'importSoal'])->name('buat-soal.import');
        Route::get('/buat-soal/export', [DosenController::class, 'exportSoal'])->name('buat-soal.export');
        Route::get('/rekap-nilai', [DosenController::class, 'rekapNilai'])->name('rekap-nilai');
        Route::get('/dasbor-realtime', [DosenController::class, 'dasborRealtime'])->name('dasbor-realtime');
        Route::get('/nilai-responsi', [DosenController::class, 'nilaiResponsi'])->name('nilai-responsi');
        Route::post('/nilai-responsi', [DosenController::class, 'storeNilaiResponsi'])->name('nilai-responsi.store');
        Route::get('/cetak-berita', [DosenController::class, 'cetakBerita'])->name('cetak-berita');
        Route::post('/cetak-berita', [DosenController::class, 'generatePDF'])->name('cetak-berita.pdf');
    });

});

require __DIR__.'/auth.php';