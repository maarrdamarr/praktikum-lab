<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Ruangan;
use App\Models\User;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    public function index() { return view('dashboard'); }

    // ─────────────────────────────────────────
    //  KELOLA JADWAL
    // ─────────────────────────────────────────

    public function kelolaJadwal()
    {
        $jadwals  = Jadwal::with(['ruangan', 'dosen'])->orderBy('hari')->orderBy('jam_mulai')->get();
        $ruangans = Ruangan::where('status', 'aktif')->get();
        $dosens   = User::where('role', 'dosen')->get();

        $hariUrutan = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

        return view('admin.kelola-jadwal', compact('jadwals', 'ruangans', 'dosens', 'hariUrutan'));
    }

    public function storeJadwal(Request $request)
    {
        $request->validate([
            'hari'       => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_mulai'  => 'required|date_format:H:i',
            'jam_selesai'=> 'required|date_format:H:i|after:jam_mulai',
            'modul'      => 'nullable|string|max:100',
            'mata_kuliah'=> 'nullable|string|max:100',
            'kelas'      => 'nullable|string|max:100',
            'ruangan_id' => 'nullable|exists:ruangans,id',
            'dosen_id'   => 'nullable|exists:users,id',
        ]);

        // Cek konflik jadwal di ruangan yang sama
        if ($request->ruangan_id) {
            $konflik = Jadwal::where('ruangan_id', $request->ruangan_id)
                ->where('hari', $request->hari)
                ->where(function ($q) use ($request) {
                    $q->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                      ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai])
                      ->orWhere(function ($q2) use ($request) {
                          $q2->where('jam_mulai', '<=', $request->jam_mulai)
                             ->where('jam_selesai', '>=', $request->jam_selesai);
                      });
                })->exists();

            if ($konflik) {
                return back()->withInput()->with('error', 'Jadwal konflik! Ruangan sudah terpakai pada jam tersebut.');
            }
        }

        Jadwal::create([
            'hari'        => $request->hari,
            'jam_mulai'   => $request->jam_mulai . ':00',
            'jam_selesai' => $request->jam_selesai . ':00',
            'modul'       => $request->modul,
            'mata_kuliah' => $request->mata_kuliah,
            'kelas'       => $request->kelas,
            'ruangan_id'  => $request->ruangan_id,
            'dosen_id'    => $request->dosen_id,
            'nomor_surat' => Jadwal::generateNomorSurat(),
        ]);

        return back()->with('success', 'Jadwal baru berhasil ditambahkan ke sistem.');
    }

    public function updateJadwal(Request $request, $id)
    {
        $jadwal = Jadwal::findOrFail($id);

        $request->validate([
            'hari'        => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_mulai'   => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'modul'       => 'nullable|string|max:100',
            'mata_kuliah' => 'nullable|string|max:100',
            'kelas'       => 'nullable|string|max:100',
            'ruangan_id'  => 'nullable|exists:ruangans,id',
            'dosen_id'    => 'nullable|exists:users,id',
        ]);

        // Cek konflik (kecuali jadwal ini sendiri)
        if ($request->ruangan_id) {
            $konflik = Jadwal::where('ruangan_id', $request->ruangan_id)
                ->where('hari', $request->hari)
                ->where('id', '!=', $id)
                ->where(function ($q) use ($request) {
                    $q->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                      ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai])
                      ->orWhere(function ($q2) use ($request) {
                          $q2->where('jam_mulai', '<=', $request->jam_mulai)
                             ->where('jam_selesai', '>=', $request->jam_selesai);
                      });
                })->exists();

            if ($konflik) {
                return back()->withInput()->with('error', 'Jadwal konflik! Ruangan sudah terpakai pada jam tersebut.');
            }
        }

        $jadwal->update([
            'hari'        => $request->hari,
            'jam_mulai'   => $request->jam_mulai . ':00',
            'jam_selesai' => $request->jam_selesai . ':00',
            'modul'       => $request->modul,
            'mata_kuliah' => $request->mata_kuliah,
            'kelas'       => $request->kelas,
            'ruangan_id'  => $request->ruangan_id,
            'dosen_id'    => $request->dosen_id,
        ]);

        return back()->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroyJadwal($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        return back()->with('success', 'Jadwal berhasil dihapus dari sistem.');
    }

    // ─────────────────────────────────────────
    //  KELOLA RUANGAN
    // ─────────────────────────────────────────

    public function kelolaRuangan()
    {
        $ruangans = Ruangan::withCount('jadwals')->get();
        return view('admin.kelola-ruangan', compact('ruangans'));
    }

    public function storeRuangan(Request $request)
    {
        $request->validate([
            'nama'       => 'required|string|max:100',
            'kapasitas'  => 'required|integer|min:1|max:500',
            'status'     => 'required|in:aktif,perawatan',
            'keterangan' => 'nullable|string|max:255',
        ]);

        Ruangan::create($request->only(['nama', 'kapasitas', 'status', 'keterangan']));

        return back()->with('success', 'Ruangan laboratorium baru berhasil ditambahkan.');
    }

    public function updateRuangan(Request $request, $id)
    {
        $ruangan = Ruangan::findOrFail($id);

        $request->validate([
            'nama'       => 'required|string|max:100',
            'kapasitas'  => 'required|integer|min:1|max:500',
            'status'     => 'required|in:aktif,perawatan',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $ruangan->update($request->only(['nama', 'kapasitas', 'status', 'keterangan']));

        return back()->with('success', 'Data ruangan berhasil diperbarui.');
    }

    public function destroyRuangan($id)
    {
        $ruangan = Ruangan::findOrFail($id);
        $ruangan->delete();

        return back()->with('success', 'Ruangan berhasil dihapus dari sistem.');
    }

    public function detailRuangan($id)
    {
        $ruangan  = Ruangan::findOrFail($id);
        $jadwals  = Jadwal::with('dosen')->where('ruangan_id', $id)->orderBy('hari')->orderBy('jam_mulai')->get();

        $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

        // Buat grid: per hari, per jam (00–23)
        $grid = [];
        foreach ($hariList as $hari) {
            $jadwalHari = $jadwals->where('hari', $hari)->values();
            $slots = [];
            for ($jam = 0; $jam < 24; $jam++) {
                $jamStr  = sprintf('%02d:00', $jam);
                $jamEnd  = sprintf('%02d:00', $jam + 1);
                $terisi  = null;
                foreach ($jadwalHari as $j) {
                    $mulai   = substr($j->jam_mulai, 0, 5);
                    $selesai = substr($j->jam_selesai, 0, 5);
                    if ($mulai <= $jamStr && $selesai > $jamStr) {
                        $terisi = $j;
                        break;
                    }
                }
                $slots[$jamStr] = $terisi;
            }
            $grid[$hari] = $slots;
        }

        $dosens   = User::where('role', 'dosen')->get();
        $ruangans = Ruangan::where('status', 'aktif')->get();

        return view('admin.detail-ruangan', compact('ruangan', 'jadwals', 'grid', 'hariList', 'dosens', 'ruangans'));
    }

    // Tambah jadwal langsung dari halaman detail ruangan
    public function aturJadwalRuangan(Request $request, $id)
    {
        $ruangan = Ruangan::findOrFail($id);

        $request->validate([
            'hari'        => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_mulai'   => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'modul'       => 'nullable|string|max:100',
            'mata_kuliah' => 'nullable|string|max:100',
            'kelas'       => 'nullable|string|max:100',
            'dosen_id'    => 'nullable|exists:users,id',
        ]);

        // Cek konflik
        $konflik = Jadwal::where('ruangan_id', $id)
            ->where('hari', $request->hari)
            ->where(function ($q) use ($request) {
                $q->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                  ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai])
                  ->orWhere(function ($q2) use ($request) {
                      $q2->where('jam_mulai', '<=', $request->jam_mulai)
                         ->where('jam_selesai', '>=', $request->jam_selesai);
                  });
            })->exists();

        if ($konflik) {
            return back()->with('error', 'Jadwal konflik! Slot jam tersebut sudah terpakai.');
        }

        Jadwal::create([
            'hari'        => $request->hari,
            'jam_mulai'   => $request->jam_mulai . ':00',
            'jam_selesai' => $request->jam_selesai . ':00',
            'modul'       => $request->modul,
            'mata_kuliah' => $request->mata_kuliah,
            'kelas'       => $request->kelas,
            'ruangan_id'  => $id,
            'dosen_id'    => $request->dosen_id,
            'nomor_surat' => Jadwal::generateNomorSurat(),
        ]);

        return back()->with('success', 'Jadwal berhasil ditambahkan ke ruangan ' . $ruangan->nama . '.');
    }

    // ─────────────────────────────────────────
    //  METHODS LAIN
    // ─────────────────────────────────────────

    public function alokasiAsisten() 
    {
        // Load semua jadwal beserta asisten yang dialokasikan
        $jadwals = Jadwal::with(['ruangan', 'asistens'])->orderBy('hari')->orderBy('jam_mulai')->get();
        
        // List asisten
        $asistens = User::where('role', 'asisten')->get();
        
        // Kalkulasi beban (Asumsi 10 jadwal = 100% load)
        $bebanKerja = [];
        foreach ($asistens as $asisten) {
            $jml = $asisten->jadwals()->count();
            $bebanKerja[$asisten->name] = min(100, ($jml / 10) * 100);
        }
        arsort($bebanKerja);

        return view('admin.alokasi-asisten', compact('jadwals', 'asistens', 'bebanKerja')); 
    }

    public function storeAlokasi(Request $request)
    {
        $data = $request->jadwal_asisten ?? [];
        
        foreach ($data as $jadwalId => $asistenIds) {
            $jadwal = Jadwal::find($jadwalId);
            if ($jadwal) {
                // array_filter membersihkan opsi kosong "Pilih Asisten..." (jika di-submit null/empty string)
                $jadwal->asistens()->sync(array_filter($asistenIds));
            }
        }

        return back()->with('success', 'Plotting asisten lab berhasil diperbarui.');
    }

    public function kelolaPengguna() 
    { 
        $users = User::where('role', 'praktikan')->orderBy('name', 'asc')->get();
        
        // Calculate statistics
        $stats = [
            'total' => $users->count(),
            'informatika' => $users->where('prodi', 'Teknik Informatika')->count(),
            'sistem_informasi' => $users->where('prodi', 'Sistem Informasi')->count(),
            'pendidikan' => $users->where('prodi', 'Pendidikan Teknologi Informasi')->count(),
        ];
        
        return view('admin.kelola-pengguna', compact('users', 'stats')); 
    }

    public function storePengguna(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'nim' => 'required|string|max:50|unique:users,nim',
            'prodi' => 'required|string|max:100',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nim' => $request->nim,
            'prodi' => $request->prodi,
            'role' => 'praktikan',
            'password' => \Hash::make($request->nim), // Default password is NIM
        ]);

        return back()->with('success', 'Akun mahasiswa baru telah berhasil dibuat.');
    }

    public function updatePengguna(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'nim' => 'required|string|max:50|unique:users,nim,' . $id,
            'prodi' => 'required|string|max:100',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'nim' => $request->nim,
            'prodi' => $request->prodi,
        ]);

        if ($request->filled('password')) {
            $user->update(['password' => \Hash::make($request->password)]);
        }

        return back()->with('success', 'Data akun mahasiswa berhasil diperbarui.');
    }

    public function destroyPengguna($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with('success', 'Akun mahasiswa berhasil dihapus.');
    }

    public function exportPengguna()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $headers = ['Nama', 'NIM', 'Email', 'No. Telepon', 'Program Studi'];

        foreach ($headers as $colIdx => $header) {
            $sheet->setCellValueByColumnAndRow($colIdx + 1, 1, $header);
        }

        $users = User::where('role', 'praktikan')->orderBy('name', 'asc')->get();
        $rowIdx = 2;
        foreach ($users as $user) {
            $sheet->setCellValueByColumnAndRow(1, $rowIdx, $user->name);
            $sheet->setCellValueByColumnAndRow(2, $rowIdx, $user->nim);
            $sheet->setCellValueByColumnAndRow(3, $rowIdx, $user->email);
            $sheet->setCellValueByColumnAndRow(4, $rowIdx, $user->phone);
            $sheet->setCellValueByColumnAndRow(5, $rowIdx, $user->prodi);
            $rowIdx++;
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="daftar_mahasiswa.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    public function importPengguna(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv|max:10240',
        ]);

        try {
            $file = $request->file('file');
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet();
            $highestRow = $sheet->getHighestRow();
            
            $importedCount = 0;
            $skippedCount = 0;
            
            for ($row = 2; $row <= $highestRow; $row++) {
                $name = trim($sheet->getCellByColumnAndRow(1, $row)->getValue() ?? '');
                $nim = trim($sheet->getCellByColumnAndRow(2, $row)->getValue() ?? '');
                $email = trim($sheet->getCellByColumnAndRow(3, $row)->getValue() ?? '');
                $phone = trim($sheet->getCellByColumnAndRow(4, $row)->getValue() ?? '');
                $prodi = trim($sheet->getCellByColumnAndRow(5, $row)->getValue() ?? '');

                if (empty($name) || empty($nim) || empty($email)) {
                    continue; // Skip rows that lack required info
                }

                // Check duplicate nim or email
                $exists = User::where('email', $email)->orWhere('nim', $nim)->exists();
                if ($exists) {
                    $skippedCount++;
                    continue;
                }

                User::create([
                    'name' => $name,
                    'nim' => $nim,
                    'email' => $email,
                    'phone' => $phone,
                    'prodi' => $prodi ?: 'Teknik Informatika', // Default to Teknik Informatika if not specified
                    'role' => 'praktikan',
                    'password' => \Hash::make($nim),
                ]);

                $importedCount++;
            }

            $message = "Berhasil mengimpor {$importedCount} akun mahasiswa.";
            if ($skippedCount > 0) {
                $message .= " Lewati {$skippedCount} akun karena NIM/Email duplikat.";
            }

            return back()->with('success', $message);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengimpor berkas Excel: ' . $e->getMessage());
        }
    }

    public function exportTemplateExcel()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $headers = ['Nama', 'NIM', 'Email', 'No. Telepon', 'Program Studi'];

        foreach ($headers as $colIdx => $header) {
            $sheet->setCellValueByColumnAndRow($colIdx + 1, 1, $header);
        }

        // Add 2 example rows
        $sheet->setCellValueByColumnAndRow(1, 2, 'Ahmad Fauzi');
        $sheet->setCellValueByColumnAndRow(2, 2, '20210001');
        $sheet->setCellValueByColumnAndRow(3, 2, 'ahmad.fauzi@univ.ac.id');
        $sheet->setCellValueByColumnAndRow(4, 2, '081234567890');
        $sheet->setCellValueByColumnAndRow(5, 2, 'Teknik Informatika');

        $sheet->setCellValueByColumnAndRow(1, 3, 'Citra Lestari');
        $sheet->setCellValueByColumnAndRow(2, 3, '20210002');
        $sheet->setCellValueByColumnAndRow(3, 3, 'citra.lestari@univ.ac.id');
        $sheet->setCellValueByColumnAndRow(4, 3, '089876543210');
        $sheet->setCellValueByColumnAndRow(5, 3, 'Sistem Informasi');

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="template_import_mahasiswa.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    public function exportTemplatePDF()
    {
        $pdf = Pdf::loadView('admin.pdf-template');
        return $pdf->download('panduan_import_mahasiswa.pdf');
    }

    public function distribusiModul() { return view('admin.distribusi-modul'); }
    public function storeModul(Request $request)
    {
        return back()->with('success', 'Modul digital berhasil diunggah dan didistribusikan.');
    }

    public function deteksiClash() { return view('admin.deteksi-clash'); }
}
