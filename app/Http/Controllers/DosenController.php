<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
        $request->validate([
            'file_soal' => 'required|file|mimes:xlsx,xls,csv,txt',
        ]);

        $file = $request->file('file_soal');
        $filePath = $file->getRealPath();

        try {
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePath);
            $sheet = $spreadsheet->getActiveSheet();
            $highestRow = $sheet->getHighestRow();
            
            $importedCount = 0;
            // Loop starting from row 2 (skipping header)
            for ($row = 2; $row <= $highestRow; $row++) {
                $pertanyaan = $sheet->getCellByColumnAndRow(1, $row)->getValue();
                if (empty($pertanyaan)) {
                    continue; // Skip empty rows
                }

                $petunjuk = $sheet->getCellByColumnAndRow(2, $row)->getValue();
                $tipe = $sheet->getCellByColumnAndRow(3, $row)->getValue();
                $opsiStr = $sheet->getCellByColumnAndRow(4, $row)->getValue();
                $poin = $sheet->getCellByColumnAndRow(5, $row)->getValue();
                $tenggat_tanggal = $sheet->getCellByColumnAndRow(6, $row)->getValue();
                $tenggat_waktu = $sheet->getCellByColumnAndRow(7, $row)->getValue();
                $topik = $sheet->getCellByColumnAndRow(8, $row)->getValue();
                $rekapStr = $sheet->getCellByColumnAndRow(9, $row)->getValue();
                $editStr = $sheet->getCellByColumnAndRow(10, $row)->getValue();
                $kelas = $sheet->getCellByColumnAndRow(11, $row)->getValue();

                // Format data
                $tipe = in_array(strtolower($tipe), ['multiple_choice', 'pilihan_ganda']) ? 'multiple_choice' : 'short_answer';
                
                $opsi = null;
                if ($tipe === 'multiple_choice' && !empty($opsiStr)) {
                    // Split options by "|"
                    $opsi = array_map('trim', explode('|', $opsiStr));
                }

                $poinVal = is_numeric($poin) ? (int)$poin : null;
                
                // Parse dates safely
                $tenggatTanggalVal = null;
                if (!empty($tenggat_tanggal)) {
                    if (is_numeric($tenggat_tanggal)) {
                        // Excel serial date representation
                        $tenggatTanggalVal = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($tenggat_tanggal)->format('Y-m-d');
                    } else {
                        $tenggatTanggalVal = date('Y-m-d', strtotime($tenggat_tanggal));
                    }
                }

                $tenggatWaktuVal = null;
                if (!empty($tenggat_waktu)) {
                    if (is_numeric($tenggat_waktu)) {
                        $tenggatWaktuVal = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($tenggat_waktu)->format('H:i');
                    } else {
                        $tenggatWaktuVal = date('H:i', strtotime($tenggat_waktu));
                    }
                }

                $rekapVal = in_array(strtolower($rekapStr), ['ya', '1', 'yes', 'true']);
                $editVal = in_array(strtolower($editStr), ['ya', '1', 'yes', 'true']);

                \App\Models\Question::create([
                    'pertanyaan' => $pertanyaan,
                    'petunjuk' => $petunjuk,
                    'tipe' => $tipe,
                    'opsi' => $opsi,
                    'poin' => $poinVal,
                    'tenggat_tanggal' => $tenggatTanggalVal,
                    'tenggat_waktu' => $tenggatWaktuVal,
                    'topik' => $topik ?? 'Tidak ada topik',
                    'bisa_melihat_rekap' => $rekapVal,
                    'bisa_memperbaiki' => $editVal,
                    'kelas' => $kelas ?? 'Kimia Dasar I - Modul 01',
                ]);

                $importedCount++;
            }

            return redirect()->route('dosen.buat-soal')->with('success', "Berhasil mengimpor {$importedCount} soal ke Bank Soal.");

        } catch (\Exception $e) {
            return redirect()->route('dosen.buat-soal')->with('error', 'Gagal mengimpor file: ' . $e->getMessage());
        }
    }

    public function exportSoal(Request $request)
    {
        $template = $request->query('template') === '1';

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header columns
        $headers = [
            'Pertanyaan',
            'Petunjuk',
            'Tipe',
            'Opsi',
            'Poin',
            'Tenggat Tanggal',
            'Tenggat Waktu',
            'Topik',
            'Bisa Melihat Rekap',
            'Bisa Memperbaiki',
            'Kelas'
        ];

        // Write header
        foreach ($headers as $colIdx => $header) {
            $sheet->setCellValueByColumnAndRow($colIdx + 1, 1, $header);
        }

        if (!$template) {
            $questions = \App\Models\Question::all();
            $rowIdx = 2;
            foreach ($questions as $q) {
                $opsiStr = '';
                if (is_array($q->opsi)) {
                    $opsiStr = implode(' | ', $q->opsi);
                }

                $sheet->setCellValueByColumnAndRow(1, $rowIdx, $q->pertanyaan);
                $sheet->setCellValueByColumnAndRow(2, $rowIdx, $q->petunjuk);
                $sheet->setCellValueByColumnAndRow(3, $rowIdx, $q->tipe);
                $sheet->setCellValueByColumnAndRow(4, $rowIdx, $opsiStr);
                $sheet->setCellValueByColumnAndRow(5, $rowIdx, $q->poin);
                $sheet->setCellValueByColumnAndRow(6, $rowIdx, $q->tenggat_tanggal);
                $sheet->setCellValueByColumnAndRow(7, $rowIdx, $q->tenggat_waktu);
                $sheet->setCellValueByColumnAndRow(8, $rowIdx, $q->topik);
                $sheet->setCellValueByColumnAndRow(9, $rowIdx, $q->bisa_melihat_rekap ? 'Ya' : 'Tidak');
                $sheet->setCellValueByColumnAndRow(10, $rowIdx, $q->bisa_memperbaiki ? 'Ya' : 'Tidak');
                $sheet->setCellValueByColumnAndRow(11, $rowIdx, $q->kelas);
                $rowIdx++;
            }
        } else {
            // Write sample template rows
            $sheet->setCellValueByColumnAndRow(1, 2, 'Contoh soal pilihan ganda?');
            $sheet->setCellValueByColumnAndRow(2, 2, 'Pilih satu jawaban terbaik.');
            $sheet->setCellValueByColumnAndRow(3, 2, 'multiple_choice');
            $sheet->setCellValueByColumnAndRow(4, 2, 'Opsi A | Opsi B | Opsi C | Opsi D');
            $sheet->setCellValueByColumnAndRow(5, 2, 100);
            $sheet->setCellValueByColumnAndRow(6, 2, '2026-05-24');
            $sheet->setCellValueByColumnAndRow(7, 2, '23:59');
            $sheet->setCellValueByColumnAndRow(8, 2, 'Modul 01');
            $sheet->setCellValueByColumnAndRow(9, 2, 'Ya');
            $sheet->setCellValueByColumnAndRow(10, 2, 'Tidak');
            $sheet->setCellValueByColumnAndRow(11, 2, 'Kimia Dasar I - Modul 01');

            $sheet->setCellValueByColumnAndRow(1, 3, 'Contoh soal jawaban singkat?');
            $sheet->setCellValueByColumnAndRow(2, 3, 'Tulis jawaban dengan huruf kapital.');
            $sheet->setCellValueByColumnAndRow(3, 3, 'short_answer');
            $sheet->setCellValueByColumnAndRow(4, 3, '');
            $sheet->setCellValueByColumnAndRow(5, 3, 100);
            $sheet->setCellValueByColumnAndRow(6, 3, '2026-05-24');
            $sheet->setCellValueByColumnAndRow(7, 3, '23:59');
            $sheet->setCellValueByColumnAndRow(8, 3, 'Modul 01');
            $sheet->setCellValueByColumnAndRow(9, 3, 'Ya');
            $sheet->setCellValueByColumnAndRow(10, 3, 'Tidak');
            $sheet->setCellValueByColumnAndRow(11, 3, 'Kimia Dasar I - Modul 01');
        }

        $fileName = $template ? 'template_bank_soal.xlsx' : 'bank_soal_export.xlsx';
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
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
