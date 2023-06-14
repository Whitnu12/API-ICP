<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\JenisLaporan;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jenis_laporan', function (Blueprint $table) {
            $table->id('id_jenis');
            $table->string('jenis_laporan');
            $table->timestamps();
        });
        $jenisLaporan = [
            'laporan_pendidikan',
            'laporan_tugas',
            'laporan_kegiatan',
        ];

        foreach ($jenisLaporan as $jenis) {
            JenisLaporan::create([
                'jenis_laporan' => $jenis,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_laporan');
    }
};
