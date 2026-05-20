<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->text('pertanyaan');
            $table->text('petunjuk')->nullable();
            $table->string('tipe'); // short_answer, multiple_choice
            $table->json('opsi')->nullable();
            $table->integer('poin')->nullable();
            $table->date('tenggat_tanggal')->nullable();
            $table->time('tenggat_waktu')->nullable();
            $table->string('topik')->nullable();
            $table->boolean('bisa_melihat_rekap')->default(true);
            $table->boolean('bisa_memperbaiki')->default(false);
            $table->string('kelas')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
