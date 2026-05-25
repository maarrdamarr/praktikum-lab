<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'hari',
        'jam_mulai',
        'jam_selesai',
        'modul',
        'mata_kuliah',
        'kelas',
        'ruangan_id',
        'dosen_id',
        'nomor_surat',
    ];

    protected $casts = [
        'jam_mulai'   => 'datetime:H:i',
        'jam_selesai' => 'datetime:H:i',
    ];

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }

    public function dosen()
    {
        return $this->belongsTo(User::class, 'dosen_id');
    }

    public function asistens()
    {
        return $this->belongsToMany(User::class, 'asisten_jadwal');
    }

    // Generate nomor surat otomatis
    public static function generateNomorSurat(): string
    {
        $year  = date('Y');
        $month = date('m');
        $count = self::whereYear('created_at', $year)->whereMonth('created_at', $month)->count() + 1;
        return sprintf('PCM-LAB/%s/%s/%04d', $year, $month, $count);
    }

    // Format jam untuk tampil
    public function getJamMulaiFormatAttribute(): string
    {
        return \Carbon\Carbon::parse($this->attributes['jam_mulai'])->format('H:i');
    }

    public function getJamSelesaiFormatAttribute(): string
    {
        return \Carbon\Carbon::parse($this->attributes['jam_selesai'])->format('H:i');
    }
}
