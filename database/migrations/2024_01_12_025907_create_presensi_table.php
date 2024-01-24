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
        Schema::create('presensi', function (Blueprint $table) {
            $table->id('id_presensi');
            $table->string('created_by');
            $table->unsignedBigInteger('id_guru');
            $table->unsignedBigInteger('id_mapel');

            $table->foreign('id_guru')->references('id_guru')->on('gurus')->onDelete('cascade');
            $table->foreign('id_mapel')->references('id_mapel')->on('mata_pelajarans')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensi');
    }
};
