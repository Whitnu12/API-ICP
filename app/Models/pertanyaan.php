<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pertanyaan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_pertanyaan';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['content_soal', 'skor', 'id_kuis'];

    public function kuis()
    {
        return $this->belongsTo(Kuis::class, 'id_kuis');
    }

    // Tambahan relasi dengan pilihan jawaban
    public function pilihanJawaban()
    {
        return $this->hasMany(PilihanJawaban::class, 'id_pertanyaan');
    }
}
