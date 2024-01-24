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
        Schema::create('pilihan_jawaban', function (Blueprint $table) {
            $table->id('id_pilihan');
            $table->unsignedBigInteger('id_pertanyaan')->nullable();
            $table->foreign('id_pertanyaan')->references('id_pertanyaan')->on('pertanyaan')->onDelete('cascade');
            $table->boolean('is_jawaban_benar')->default(false);
            $table->string('isi_pilihan', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pilihan_jawaban');
    }
};
