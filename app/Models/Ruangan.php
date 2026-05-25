<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kapasitas',
        'status',
        'keterangan',
    ];

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }

    // Ambil jadwal yang terisi untuk hari tertentu
    public function jadwalHari(string $hari)
    {
        return $this->jadwals()->where('hari', $hari)->orderBy('jam_mulai')->get();
    }

    // Cek apakah slot jam tertentu di hari tertentu sudah terisi
    public function isSlotTerisi(string $hari, string $jam): bool
    {
        return $this->jadwals()
            ->where('hari', $hari)
            ->where('jam_mulai', '<=', $jam . ':00')
            ->where('jam_selesai', '>', $jam . ':00')
            ->exists();
    }

    public function totalJadwal(): int
    {
        return $this->jadwals()->count();
    }
}
