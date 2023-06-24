<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    use HasFactory;
    protected $table = 'mata_pelajarans';


    protected $primaryKey = 'kode_mapel';

    protected $fillable = ['nama_mapel', 'id_jurusan',  'id_guru'];

    public function jurusan()
    {
        return $this->belongsTo(jurusan::class, 'id_jurusan', 'id_jurusan');
    }

    public function guru()
    {
        return $this->belongsToMany(guru::class, 'guru_mata_pelajaran', 'kode_mapel', 'id_guru');
    }
    
}

