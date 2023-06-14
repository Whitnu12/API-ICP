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
        Schema::create('laporans', function (Blueprint $table) {
            $table->id('id_laporan');
            $table->string('judul_laporan');
            $table->string('deskripsi_laporan');
            $table->date('tanggal');
            $table->string('gambar');
            $table->unsignedBigInteger('jenis_laporan_id');
            $table->timestamps();

            $table->foreign('jenis_laporan_id')->references('id_jenis')->on('jenis_laporan');
        });
       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
