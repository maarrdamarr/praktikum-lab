<?php

namespace Database\Seeders;

use App\Models\Jadwal;
use App\Models\Ruangan;
use Illuminate\Database\Seeder;

class RuanganJadwalSeeder extends Seeder
{
    public function run(): void
    {
        // Buat beberapa ruangan contoh
        $ruangans = [
            ['nama' => 'Lab Kimia Dasar',    'kapasitas' => 40, 'status' => 'aktif',     'keterangan' => 'Gedung A Lt. 1'],
            ['nama' => 'Lab Fisika Atom',     'kapasitas' => 35, 'status' => 'aktif',     'keterangan' => 'Gedung B Lt. 2'],
            ['nama' => 'Lab Komputer A',      'kapasitas' => 30, 'status' => 'aktif',     'keterangan' => 'Gedung C Lt. 3 — 30 PC'],
            ['nama' => 'Lab Mikrobiologi',    'kapasitas' => 25, 'status' => 'aktif',     'keterangan' => 'Gedung A Lt. 2'],
            ['nama' => 'Lab Elektro',         'kapasitas' => 20, 'status' => 'perawatan', 'keterangan' => 'Sedang renovasi s.d. Juni 2026'],
        ];

        foreach ($ruangans as $data) {
            Ruangan::firstOrCreate(['nama' => $data['nama']], $data);
        }

        // Buat beberapa jadwal contoh
        $kimia = Ruangan::where('nama', 'Lab Kimia Dasar')->first();
        $fisika = Ruangan::where('nama', 'Lab Fisika Atom')->first();

        if ($kimia && !Jadwal::where('ruangan_id', $kimia->id)->exists()) {
            $jadwals = [
                ['hari' => 'Senin',  'jam_mulai' => '08:00', 'jam_selesai' => '10:00', 'modul' => 'Modul 01', 'mata_kuliah' => 'Kimia Dasar I',   'kelas' => 'A', 'ruangan_id' => $kimia->id],
                ['hari' => 'Selasa', 'jam_mulai' => '13:00', 'jam_selesai' => '15:00', 'modul' => 'Modul 02', 'mata_kuliah' => 'Kimia Dasar I',   'kelas' => 'B', 'ruangan_id' => $kimia->id],
                ['hari' => 'Rabu',   'jam_mulai' => '10:00', 'jam_selesai' => '12:00', 'modul' => 'Modul 01', 'mata_kuliah' => 'Kimia Analitik',  'kelas' => 'A', 'ruangan_id' => $fisika->id],
                ['hari' => 'Kamis',  'jam_mulai' => '07:00', 'jam_selesai' => '09:00', 'modul' => 'Modul 03', 'mata_kuliah' => 'Fisika Dasar',    'kelas' => 'C', 'ruangan_id' => $fisika->id],
                ['hari' => 'Jumat',  'jam_mulai' => '14:00', 'jam_selesai' => '17:00', 'modul' => 'Modul 04', 'mata_kuliah' => 'Kimia Organik',   'kelas' => 'D', 'ruangan_id' => $kimia->id],
            ];

            foreach ($jadwals as $jData) {
                Jadwal::create(array_merge($jData, [
                    'nomor_surat' => Jadwal::generateNomorSurat(),
                ]));
            }
        }
    }
}
