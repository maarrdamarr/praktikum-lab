<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function praktikan()
    {
        return view('praktikan.dashboard');
    }

    public function asisten()
    {
        return view('asisten.dashboard');
    }

    public function admin()
    {
        return view('admin.dashboard');
    }

    public function dosen()
    {
        return view('dosen.dashboard');
    }

    public function absensi()
    {
        return view('absensi');
    }

    public function storeAbsensi(Request $request)
    {
        if (!auth()->user()->identity_path) return back()->with('error', 'Akses ditolak! Anda wajib mengunggah kartu identitas di menu Profil terlebih dahulu.');
        return back()->with('success', 'Presensi Anda telah berhasil dicatat ke sistem.');
    }

    public function profile() { return view('profil'); }
    public function updateProfile(Request $request)
    {
        // Mocking saving path
        auth()->user()->identity_path = 'uploads/identities/mock_ktm.png';
        return back()->with('success', 'Profil dan identitas Anda telah berhasil diperbarui. Akses fitur kini terbuka.');
    }
}