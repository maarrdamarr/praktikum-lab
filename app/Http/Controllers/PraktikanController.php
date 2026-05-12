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
        return redirect()->route('praktikan.dashboard')->with('success', 'Jawaban pre-test Anda telah tersimpan. Selamat memulai praktikum!');
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
