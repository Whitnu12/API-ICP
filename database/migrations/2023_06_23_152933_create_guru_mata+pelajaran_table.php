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
        Schema::create('guru_mata_pelajaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_guru');
            $table->unsignedBigInteger('kode_mapel');
            $table->timestamps();
            $table->foreign('id_guru')->references('id_guru')->on('gurus')->onDelete('cascade');
            $table->foreign('kode_mapel')->references('kode_mapel')->on('mata_pelajarans')->onDelete('cascade');
        });
    } 

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
