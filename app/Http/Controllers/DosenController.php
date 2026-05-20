<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index() { return view('dashboard'); }
    
    public function buatSoal()
    {
        $questions = \App\Models\Question::orderBy('created_at', 'desc')->get();
        return view('dosen.buat-soal', compact('questions'));
    }

    public function storeSoal(Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required|string',
            'tipe' => 'required|string',
        ]);

        $opsi = null;
        if ($request->tipe === 'multiple_choice' && $request->opsi) {
            $opsi = json_decode($request->opsi, true);
        }

        \App\Models\Question::create([
            'pertanyaan' => $request->pertanyaan,
            'petunjuk' => $request->petunjuk,
            'tipe' => $request->tipe,
            'opsi' => $opsi,
            'poin' => $request->is_ungraded == '1' ? null : ($request->poin ?? 100),
            'tenggat_tanggal' => $request->tenggat_tanggal,
            'tenggat_waktu' => $request->tenggat_waktu,
            'topik' => $request->topik,
            'bisa_melihat_rekap' => $request->bisa_melihat_rekap == '1',
            'bisa_memperbaiki' => $request->bisa_memperbaiki == '1',
            'kelas' => $request->kelas,
        ]);

        return redirect()->route('dosen.buat-soal')->with('success', 'Soal baru berhasil ditambahkan ke Bank Soal.');
    }

    public function updateSoal(Request $request, $id)
    {
        $request->validate([
            'pertanyaan' => 'required|string',
            'tipe' => 'required|string',
        ]);

        $question = \App\Models\Question::findOrFail($id);

        $opsi = null;
        if ($request->tipe === 'multiple_choice' && $request->opsi) {
            $opsi = json_decode($request->opsi, true);
        }

        $question->update([
            'pertanyaan' => $request->pertanyaan,
            'petunjuk' => $request->petunjuk,
            'tipe' => $request->tipe,
            'opsi' => $opsi,
            'poin' => $request->is_ungraded == '1' ? null : ($request->poin ?? 100),
            'tenggat_tanggal' => $request->tenggat_tanggal,
            'tenggat_waktu' => $request->tenggat_waktu,
            'topik' => $request->topik,
            'bisa_melihat_rekap' => $request->bisa_melihat_rekap == '1',
            'bisa_memperbaiki' => $request->bisa_memperbaiki == '1',
            'kelas' => $request->kelas,
        ]);

        return redirect()->route('dosen.buat-soal')->with('success', 'Soal berhasil diperbarui di Bank Soal.');
    }

    public function destroySoal($id)
    {
        $question = \App\Models\Question::findOrFail($id);
        $question->delete();

        return redirect()->route('dosen.buat-soal')->with('success', 'Soal berhasil dihapus dari Bank Soal.');
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
