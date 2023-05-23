<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class jurusan extends Model
{
    use HasFactory;
    
    protected $table = 'jurusan';
    protected $fillable = ['nama_jurusan'];

    protected $primaryKey = 'id_jurusan';

    public function mataPelajarans()
    {
        return $this->hasMany(MataPelajaran::class, 'id_jurusan');
    }


}
