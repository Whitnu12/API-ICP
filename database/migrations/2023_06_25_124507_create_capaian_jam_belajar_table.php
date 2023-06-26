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
        Schema::create('capaian_jam_belajar', function (Blueprint $table) {
            $table->id("id_capaian");
            $table->unsignedBigInteger("id_guru");
            $table->unsignedBigInteger("kode_mapel");
            $table->integer("capaian_jam");
            $table->integer("jam_tercapai");
            $table->foreign('id_guru')->references('id_guru')->on('gurus')->onDelete('cascade');
            $table->foreign('kode_mapel')->references('kode_mapel')->on('mata_pelajarans')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('capaian_jam_belajar');
    }
};
