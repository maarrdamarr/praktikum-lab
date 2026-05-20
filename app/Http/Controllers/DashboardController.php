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
        $request->validate([
            'name'     => 'required|string|max:255',
            'phone'    => 'nullable|string|max:20',
            'prodi'    => 'nullable|string|max:100',
            'identity' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $user = auth()->user();
        $data = [
            'name'  => $request->name,
            'phone' => $request->phone,
            'prodi' => $request->prodi,
        ];

        if ($request->hasFile('identity')) {
            $path = $request->file('identity')->store('identities', 'public');
            $data['identity_path'] = $path;
        }

        $user->update($data);

        return back()->with('success', 'Profil dan identitas Anda telah berhasil diperbarui. Akses fitur kini terbuka.');
    }
}