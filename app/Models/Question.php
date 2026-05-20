<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'pertanyaan',
        'petunjuk',
        'tipe',
        'opsi',
        'poin',
        'tenggat_tanggal',
        'tenggat_waktu',
        'topik',
        'bisa_melihat_rekap',
        'bisa_memperbaiki',
        'kelas',
    ];

    protected $casts = [
        'opsi' => 'array',
        'bisa_melihat_rekap' => 'boolean',
        'bisa_memperbaiki' => 'boolean',
    ];
}
