<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asisten_jadwal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jadwal_id')->constrained('jadwals')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // Ini asistennya
            $table->timestamps();

            // Mencegah duplikasi: 1 asisten tidak boleh dialokasikan 2x di jadwal yg sama
            $table->unique(['jadwal_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asisten_jadwal');
    }
};
