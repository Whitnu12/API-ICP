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
        Schema::create('mata_pelajarans', function (Blueprint $table) {
            $table->id('id_mapel');
            $table->unsignedBigInteger('id_guru');
            $table->foreign('id_guru')->references('id_guru')->on('gurus')->onDelete('cascade');
            $table->string('nama_mapel')->unique();
            $table->string('deskripsi');
            $table->string('enroll_code')->unique();
            $table->string('created_by');
            $table->timestamps();
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
