<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\JenisLaporan;
use App\Models\gambar_laporan;

class laporan extends Model
{
    use HasFactory;
    protected $table = 'laporans';

    protected $primaryKey = 'id_laporan';

    protected $fillable = [
        'judul_laporan',
        'deskripsi_laporan',
        'tanggal',
        'id_jenis',
        'id_guru',
    ];

    public function jenisLaporan()
    {
        return $this->belongsTo(JenisLaporan::class, 'id_jenis');
    }

    public function gambarLaporan()
    {
        return $this->hasMany(gambar_laporan::class, 'id_laporan');
    }

    public function guru(){
        return $this->belongsTo(guru::class, 'id_guru' , 'id_guru');
    }
}
