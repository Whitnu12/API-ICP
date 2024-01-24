<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jawaban', function (Blueprint $table) {
            $table->id('id_jawaban');
            $table->unsignedBigInteger('id_siswa');
            $table->unsignedBigInteger('id_pertanyaan');
            $table->unsignedBigInteger('id_pilihan'); // ID dari tabel pilihan jawaban
            // Tambahkan kolom-kolom lain sesuai kebutuhan
            $table->timestamps();

            $table->foreign('id_siswa')->references('id_siswa')->on('siswa')->onDelete('cascade');
            $table->foreign('id_pertanyaan')->references('id_pertanyaan')->on('pertanyaan')->onDelete('cascade');
            $table->foreign('id_pilihan')->references('id_pilihan')->on('pilihan_jawaban')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban');
    }
};
