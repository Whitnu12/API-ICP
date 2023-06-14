<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\JenisLaporan;

class laporan extends Model
{
    use HasFactory;
    protected $table = 'laporans';

    protected $primaryKey = 'id_laporan';

    protected $fillable = [
        'judul_laporan',
        'deskripsi_laporan',
        'tanggal',
        'gambar',
        'jenis_laporan_id',
    ];

    public function jenisLaporan()
    {
        return $this->belongsTo(JenisLaporan::class);
    }
}
