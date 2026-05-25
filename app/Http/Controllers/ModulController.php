<?php

namespace App\Http\Controllers;

use App\Models\Modul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ModulController extends Controller
{
    // ─────────────────────────────────────────
    //  Shared: lihat modul sesuai role
    // ─────────────────────────────────────────

    /**
     * Dipakai oleh: praktikan, asisten, dosen
     * Tampilkan daftar modul yang boleh diakses role tersebut.
     */
    public function index()
    {
        $role   = auth()->user()->role;
        $moduls = Modul::where('status', 'aktif')
            ->when($role === 'asisten',   fn($q) => $q->where('akses_asisten', true))
            ->when($role === 'praktikan', fn($q) => $q->where('akses_praktikan', true))
            ->when($role === 'dosen',     fn($q) => $q->where('akses_dosen', true))
            ->orderBy('nomor_modul')
            ->get();

        return view($role . '.modul', compact('moduls'));
    }

    /**
     * Download file modul — cek akses dulu.
     */
    public function download($id)
    {
        $modul = Modul::findOrFail($id);
        $role  = auth()->user()->role;

        if (!$modul->hasAccess($role)) {
            return back()->with('error', 'Anda tidak memiliki akses untuk mengunduh modul ini.');
        }

        if (!$modul->file_path || !Storage::exists($modul->file_path)) {
            return back()->with('error', 'File modul tidak ditemukan di server.');
        }

        return Storage::download($modul->file_path, $modul->file_original_name ?? $modul->judul . '.pdf');
    }

    // ─────────────────────────────────────────
    //  Admin: full CRUD distribusi modul
    // ─────────────────────────────────────────

    public function adminIndex()
    {
        $moduls = Modul::with('uploader')->orderBy('nomor_modul')->get();
        return view('admin.distribusi-modul', compact('moduls'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'        => 'required|string|max:150',
            'nomor_modul'  => 'required|string|max:20',
            'mata_kuliah'  => 'nullable|string|max:100',
            'versi'        => 'nullable|string|max:20',
            'deskripsi'    => 'nullable|string|max:500',
            'file_modul'   => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,zip|max:20480', // 20MB
            'akses_asisten'   => 'nullable',
            'akses_praktikan' => 'nullable',
            'akses_dosen'     => 'nullable',
        ]);

        $data = [
            'judul'           => $request->judul,
            'nomor_modul'     => $request->nomor_modul,
            'mata_kuliah'     => $request->mata_kuliah,
            'versi'           => $request->versi ?? '1.0',
            'deskripsi'       => $request->deskripsi,
            'status'          => 'aktif',
            'akses_asisten'   => $request->has('akses_asisten'),
            'akses_praktikan' => $request->has('akses_praktikan'),
            'akses_dosen'     => $request->has('akses_dosen'),
            'uploaded_by'     => auth()->id(),
        ];

        if ($request->hasFile('file_modul')) {
            $file = $request->file('file_modul');
            $path = $file->store('moduls', 'public');
            $data['file_path']          = $path;
            $data['file_original_name'] = $file->getClientOriginalName();
            $data['file_size']          = $file->getSize();
        }

        Modul::create($data);

        return back()->with('success', 'Modul "' . $request->judul . '" berhasil ditambahkan dan didistribusikan.');
    }

    public function update(Request $request, $id)
    {
        $modul = Modul::findOrFail($id);

        $request->validate([
            'judul'       => 'required|string|max:150',
            'nomor_modul' => 'required|string|max:20',
            'mata_kuliah' => 'nullable|string|max:100',
            'versi'       => 'nullable|string|max:20',
            'deskripsi'   => 'nullable|string|max:500',
            'status'      => 'required|in:aktif,arsip',
            'file_modul'  => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,zip|max:20480',
            'akses_asisten'   => 'nullable',
            'akses_praktikan' => 'nullable',
            'akses_dosen'     => 'nullable',
        ]);

        $data = [
            'judul'           => $request->judul,
            'nomor_modul'     => $request->nomor_modul,
            'mata_kuliah'     => $request->mata_kuliah,
            'versi'           => $request->versi ?? $modul->versi,
            'deskripsi'       => $request->deskripsi,
            'status'          => $request->status,
            'akses_asisten'   => $request->has('akses_asisten'),
            'akses_praktikan' => $request->has('akses_praktikan'),
            'akses_dosen'     => $request->has('akses_dosen'),
        ];

        // Ganti file jika ada upload baru
        if ($request->hasFile('file_modul')) {
            // Hapus file lama
            if ($modul->file_path && Storage::disk('public')->exists($modul->file_path)) {
                Storage::disk('public')->delete($modul->file_path);
            }
            $file = $request->file('file_modul');
            $path = $file->store('moduls', 'public');
            $data['file_path']          = $path;
            $data['file_original_name'] = $file->getClientOriginalName();
            $data['file_size']          = $file->getSize();
        }

        $modul->update($data);

        return back()->with('success', 'Modul "' . $request->judul . '" berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $modul = Modul::findOrFail($id);

        // Hapus file fisik
        if ($modul->file_path && Storage::disk('public')->exists($modul->file_path)) {
            Storage::disk('public')->delete($modul->file_path);
        }

        $judul = $modul->judul;
        $modul->delete();

        return back()->with('success', 'Modul "' . $judul . '" berhasil dihapus dari sistem.');
    }

    public function toggleStatus($id)
    {
        $modul = Modul::findOrFail($id);
        $modul->update(['status' => $modul->status === 'aktif' ? 'arsip' : 'aktif']);

        return back()->with('success', 'Status modul berhasil diubah menjadi ' . $modul->status . '.');
    }
}
