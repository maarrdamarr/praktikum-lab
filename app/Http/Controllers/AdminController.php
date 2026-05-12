<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() { return view('dashboard'); }
    
    public function kelolaJadwal() { return view('admin.kelola-jadwal'); }
    public function storeJadwal(Request $request)
    {
        return back()->with('success', 'Jadwal praktikum baru telah berhasil ditambahkan.');
    }

    public function alokasiAsisten() { return view('admin.alokasi-asisten'); }
    public function storeAlokasi(Request $request)
    {
        return back()->with('success', 'Plotting asisten lab berhasil diperbarui.');
    }

    public function kelolaPengguna() { return view('admin.kelola-pengguna'); }
    public function storePengguna(Request $request)
    {
        return back()->with('success', 'Akun mahasiswa baru telah berhasil dibuat.');
    }
    public function importPengguna(Request $request)
    {
        return back()->with('success', 'Berhasil mengimpor data mahasiswa dari berkas Excel.');
    }
    public function exportPengguna()
    {
        return back()->with('success', 'Berkas Excel akun mahasiswa sedang diekspor.');
    }

    public function distribusiModul() { return view('admin.distribusi-modul'); }
    public function storeModul(Request $request)
    {
        return back()->with('success', 'Modul digital berhasil diunggah dan didistribusikan.');
    }

    public function kelolaRuangan() { return view('admin.kelola-ruangan'); }
    public function storeRuangan(Request $request)
    {
        return back()->with('success', 'Data ruangan laboratorium berhasil diperbarui.');
    }

    public function deteksiClash() { return view('admin.deteksi-clash'); }
}
