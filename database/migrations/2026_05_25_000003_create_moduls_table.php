<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('moduls', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('nomor_modul'); // Modul 01, 02, dst
            $table->string('mata_kuliah')->nullable();
            $table->string('versi')->default('1.0');
            $table->string('file_path')->nullable();   // path file PDF yang diupload
            $table->string('file_original_name')->nullable();
            $table->bigInteger('file_size')->nullable(); // bytes
            $table->text('deskripsi')->nullable();
            $table->enum('status', ['aktif', 'arsip'])->default('aktif');
            $table->boolean('akses_asisten')->default(true);
            $table->boolean('akses_praktikan')->default(true);
            $table->boolean('akses_dosen')->default(true);
            $table->foreignId('uploaded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('moduls');
    }
};
