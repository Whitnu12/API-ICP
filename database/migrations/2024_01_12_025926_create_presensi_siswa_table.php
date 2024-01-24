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
        Schema::create('presensi_siswa', function (Blueprint $table) {
            $table->id('id_presensi_siswa');
            $table->unsignedBigInteger('id_mapel');
            $table->unsignedBigInteger('id_siswa');
            $table->unsignedBigInteger('id_presensi');
            $table->string('status');

            $table->foreign('id_siswa')->references('id_siswa')->on('siswa')->onDelete('cascade');
            $table->foreign('id_mapel')->references('id_mapel')->on('mata_pelajarans')->onDelete('cascade');
            $table->foreign('id_presensi')->references('id_presensi')->on('presensi')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensi_siswa');
    }
};
