<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class capaian_jam extends Model
{
    use HasFactory;

    protected $table = "capaian_jam_belajar";
    protected $primaryKey = "id_capaian";

    protected $fillable = [
        'id_guru',
        'kode_mapel',
        'capaian_jam',
        'jam_tercapai',
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }

    public function mapel(){
        return $this->belongsTo(MataPelajaran::class, 'kode_mapel');
    }
}
