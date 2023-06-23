<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kelas extends Model
{
    use HasFactory;
    protected $fillable = ['nama_kelas', 'angkatan', 'id_jurusan', 'jumlahMurid' ];
    protected $primaryKey = 'id_kelas';
    

    public function mataPelajarans()
    {
        return $this->hasMany(MataPelajaran::class, 'id_kelas');
    }

    public function jurusan(){
        return $this->belongsTo(jurusan::class, 'id_jurusan' , 'id_jurusan');
    }

}
