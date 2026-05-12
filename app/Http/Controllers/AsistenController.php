<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AsistenController extends Controller
{
    public function index() { return view('dashboard'); }
    
    public function validasiPresensi() { return view('asisten.validasi-presensi'); }
    public function storeValidasi(Request $request)
    {
        return back()->with('success', 'Presensi mahasiswa telah berhasil divalidasi.');
    }

    public function nilaiPreTest() { return view('asisten.nilai-pre-test'); }
    public function storeNilaiPreTest(Request $request)
    {
        return back()->with('success', 'Nilai pre-test berhasil disimpan ke dalam sistem.');
    }

    public function reviewLaporan() { return view('asisten.review-laporan'); }
    public function storeReview(Request $request)
    {
        return back()->with('success', 'Review laporan telah dikirimkan ke praktikan.');
    }

    public function inputNilai() { return view('asisten.input-nilai'); }
    public function storeNilaiAktivitas(Request $request)
    {
        return back()->with('success', 'Nilai aktivitas praktikum berhasil diperbarui.');
    }

    public function monitoringKelompok() { return view('asisten.monitoring-kelompok'); }
}
