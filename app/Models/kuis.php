<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kuis extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_kuis';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['nama_kuis', 'id_mapel'];

    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class, 'id_mapel');
    }

    // Tambahan relasi dengan pertanyaan
    public function pertanyaan()
    {
        return $this->hasMany(Pertanyaan::class, 'id_kuis');
    }
}
