<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PraktikanController extends Controller
{
    public function index() { return view('dashboard'); }
    public function pendaftaran() { return view('praktikan.pendaftaran'); }
    public function storePendaftaran(Request $request) 
    {
        if (!auth()->user()->identity_path) return back()->with('error', 'Akses ditolak! Anda wajib mengunggah kartu identitas di menu Profil terlebih dahulu.');
        return redirect()->route('praktikan.pilih-jadwal')->with('success', 'Pendaftaran berhasil! Silakan pilih jadwal praktikum Anda.');
    }

    public function pilihJadwal() { return view('praktikan.pilih-jadwal'); }
    public function storeJadwal(Request $request)
    {
        if (!auth()->user()->identity_path) return back()->with('error', 'Akses ditolak! Anda wajib mengunggah kartu identitas di menu Profil terlebih dahulu.');
        return redirect()->route('praktikan.dashboard')->with('success', 'Jadwal berhasil dipilih. Sampai jumpa di laboratorium!');
    }

    public function preTest() { return view('praktikan.pre-test'); }
    public function storePreTest(Request $request)
    {
        if (!auth()->user()->identity_path) return back()->with('error', 'Akses ditolak! Anda wajib mengunggah kartu identitas di menu Profil terlebih dahulu.');
        
        // Simpan state bahwa mahasiswa sudah mengerjakan pretest (dummy/session)
        session(['has_finished_pretest' => true, 'pretest_score' => rand(75, 100)]);

        return redirect()->route('praktikan.dashboard')->with('success', 'Jawaban pre-test Anda telah tersimpan. Selamat memulai praktikum!');
    }

    public function downloadPreTestPdf()
    {
        // Pastikan mahasiswa sudah mengerjakan
        if (!session('has_finished_pretest')) {
            return back()->with('error', 'Anda belum menyelesaikan pre-test.');
        }

        $user = auth()->user();
        $score = session('pretest_score', 85);
        $date = now()->format('d F Y H:i');

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.hasil-pre-test', compact('user', 'score', 'date'));
        
        return $pdf->download('Hasil_PreTest_'.$user->nim.'.pdf');
    }
    public function uploadLaporan() { return view('praktikan.upload-laporan'); }
    public function storeLaporan(Request $request)
    {
        if (!auth()->user()->identity_path) return back()->with('error', 'Akses ditolak! Anda wajib mengunggah kartu identitas di menu Profil terlebih dahulu.');
        return back()->with('success', 'Laporan Anda telah berhasil diunggah dan sedang menunggu review asisten.');
    }

    public function lihatNilai() { return view('praktikan.lihat-nilai'); }
    public function presensiQR() { return view('praktikan.presensi-qr'); }
}
