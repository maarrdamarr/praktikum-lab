<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index() { return view('dashboard'); }
    
    public function buatSoal() { return view('dosen.buat-soal'); }
    public function storeSoal(Request $request)
    {
        return back()->with('success', 'Soal baru berhasil ditambahkan ke Bank Soal.');
    }
    public function importSoal(Request $request)
    {
        return back()->with('success', 'Berhasil mengimpor bank soal dari berkas Excel.');
    }
    public function exportSoal()
    {
        return back()->with('success', 'Berkas Excel bank soal sedang diekspor.');
    }

    public function rekapNilai() { return view('dosen.rekap-nilai'); }
    
    public function dasborRealtime() { return view('dosen.dasbor-realtime'); }

    public function nilaiResponsi() { return view('dosen.nilai-responsi'); }
    public function storeNilaiResponsi(Request $request)
    {
        return back()->with('success', 'Nilai responsi mahasiswa telah berhasil disimpan.');
    }

    public function cetakBerita() { return view('dosen.cetak-berita'); }
    public function generatePDF(Request $request)
    {
        return back()->with('success', 'Dokumen Berita Acara (PDF) sedang dikirim ke antrean cetak.');
    }
}
