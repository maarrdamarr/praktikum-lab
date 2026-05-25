<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Modul extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'nomor_modul',
        'mata_kuliah',
        'versi',
        'file_path',
        'file_original_name',
        'file_size',
        'deskripsi',
        'status',
        'akses_asisten',
        'akses_praktikan',
        'akses_dosen',
        'uploaded_by',
    ];

    protected $casts = [
        'akses_asisten'   => 'boolean',
        'akses_praktikan' => 'boolean',
        'akses_dosen'     => 'boolean',
    ];

    // Relasi ke user yang mengunggah
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    // Ukuran file dalam format human-readable
    public function getFileSizeFormatAttribute(): string
    {
        if (!$this->file_size) return '—';
        $bytes = $this->file_size;
        if ($bytes < 1024) return $bytes . ' B';
        if ($bytes < 1048576) return round($bytes / 1024, 1) . ' KB';
        return round($bytes / 1048576, 2) . ' MB';
    }

    // Cek apakah role tertentu punya akses
    public function hasAccess(string $role): bool
    {
        return match($role) {
            'asisten'   => $this->akses_asisten,
            'praktikan' => $this->akses_praktikan,
            'dosen'     => $this->akses_dosen,
            'admin'     => true,
            default     => false,
        };
    }

    // URL download file
    public function getDownloadUrlAttribute(): ?string
    {
        if (!$this->file_path) return null;
        return Storage::url($this->file_path);
    }
}
