<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\jurusan;

class jurusan extends Model
{
    use HasFactory;

    protected $fillable = ['jurusan'];

    protected $primaryKey = 'id_jurusan';

    public function mataPelajarans()
    {
        return $this->hasMany(MataPelajaran::class, 'id_jurusan');
    }


}
