<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jadwalMengajar extends Model
{
    use HasFactory;

    protected $table = 'jadwal_mengajar';

    protected $fillable = [
        'id_guru',
        'kode_mapel',
        'id_kelas',
        'hari',
        'jam_mulai',
        'jam_selesai',
    ];

    // Relasi dengan model Guru
    public function guru()
    {
        return $this->belongsTo(guru::class, 'id_guru');
    }

    // Relasi dengan model Mapel
    public function mapel()
    {
        return $this->belongsTo(MataPelajaran::class, 'id_mapel');
    }

    // Relasi dengan model Kelas
    public function kelas()
    {
        return $this->belongsTo(kelas::class, 'id_kelas');
    }
}
