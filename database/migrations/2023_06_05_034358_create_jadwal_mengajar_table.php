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
        Schema::create('jadwal_mengajar', function (Blueprint $table) {
            $table->id('id_mengajar');
            $table->unsignedBigInteger('kode_mapel');
            $table->unsignedBigInteger('id_kelas');
            $table->unsignedBigInteger('id_guru');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->enum('hari', ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu']);
            $table->integer('jam_belajar');
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas');
            $table->foreign('kode_mapel')->references('kode_mapel')->on('mata_pelajarans');
            $table->foreign('id_guru')->references('id_guru')->on('gurus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_mengajar');
    }
};
