<?php

namespace Database\Seeders;

use App\Models\Modul;
use App\Models\User;
use Illuminate\Database\Seeder;

class ModulSeeder extends Seeder
{
    public function run(): void
    {
        if (Modul::count() > 0) return;

        $admin = User::where('role', 'admin')->first();

        $moduls = [
            [
                'judul'           => 'Pengenalan Keselamatan Laboratorium',
                'nomor_modul'     => 'Modul 01',
                'mata_kuliah'     => 'Kimia Dasar I',
                'versi'           => '2.1',
                'deskripsi'       => 'Mengenal alat-alat laboratorium, prosedur keselamatan, dan tata tertib praktikum.',
                'status'          => 'aktif',
                'akses_asisten'   => true,
                'akses_praktikan' => true,
                'akses_dosen'     => true,
                'uploaded_by'     => $admin?->id,
            ],
            [
                'judul'           => 'Titrasi Asam Basa',
                'nomor_modul'     => 'Modul 02',
                'mata_kuliah'     => 'Kimia Dasar I',
                'versi'           => '2.0',
                'deskripsi'       => 'Prinsip titrasi, kurva titrasi, indikator, dan perhitungan konsentrasi larutan.',
                'status'          => 'aktif',
                'akses_asisten'   => true,
                'akses_praktikan' => true,
                'akses_dosen'     => true,
                'uploaded_by'     => $admin?->id,
            ],
            [
                'judul'           => 'Kristalisasi dan Rekristalisasi',
                'nomor_modul'     => 'Modul 03',
                'mata_kuliah'     => 'Kimia Dasar I',
                'versi'           => '1.5',
                'deskripsi'       => 'Teknik pemisahan dan pemurnian zat padat melalui kristalisasi.',
                'status'          => 'aktif',
                'akses_asisten'   => true,
                'akses_praktikan' => true,
                'akses_dosen'     => true,
                'uploaded_by'     => $admin?->id,
            ],
            [
                'judul'           => 'Penentuan Tetapan Kesetimbangan',
                'nomor_modul'     => 'Modul 04',
                'mata_kuliah'     => 'Kimia Fisika',
                'versi'           => '1.0',
                'deskripsi'       => 'Penentuan Kc dan Kp dari reaksi kesetimbangan kimia secara eksperimental.',
                'status'          => 'aktif',
                'akses_asisten'   => true,
                'akses_praktikan' => false,
                'akses_dosen'     => true,
                'uploaded_by'     => $admin?->id,
            ],
            [
                'judul'           => 'Panduan Asisten Lab (Internal)',
                'nomor_modul'     => 'Panduan',
                'mata_kuliah'     => null,
                'versi'           => '3.0',
                'deskripsi'       => 'Dokumen panduan internal untuk asisten laboratorium. Hanya untuk asisten dan dosen.',
                'status'          => 'aktif',
                'akses_asisten'   => true,
                'akses_praktikan' => false,
                'akses_dosen'     => true,
                'uploaded_by'     => $admin?->id,
            ],
        ];

        foreach ($moduls as $data) {
            Modul::create($data);
        }
    }
}
