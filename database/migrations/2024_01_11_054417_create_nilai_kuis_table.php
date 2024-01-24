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
        Schema::create('nilai_kuis', function (Blueprint $table) {
            $table->id('id_nilai_kuis');
            $table->unsignedBigInteger('id_siswa');
            $table->unsignedBigInteger('id_kuis');
            $table->foreign('id_siswa')->references('id_siswa')->on('siswa')->onDelete('cascade');
            $table->foreign('id_kuis')->references('id_kuis')->on('kuis')->onDelete('cascade');
            $table->integer('skor_total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_kuis');
    }
};
