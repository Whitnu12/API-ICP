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
        Schema::create('kelas', function (Blueprint $table) {
            $table->id('id_kelas')->unique();
            $table->string('nama_kelas')->unique();    
            $table->unsignedBigInteger('id_jurusan');
            $table->integer('jumlahMurid');
            $table->string('angkatan');
            $table->foreign('id_jurusan')->references('id_jurusan')->on('jurusan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
