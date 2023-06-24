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
        Schema::create('mata_pelajarans', function (Blueprint $table) {
            $table->id('kode_mapel');
            $table->string('nama_mapel')->unique();
            $table->unsignedBigInteger('id_jurusan');
            $table->timestamps();
            $table->foreign('id_jurusan')->references('id_jurusan')->on('jurusan');
        
        });
        
       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mata_pelajarans');
    }
};
