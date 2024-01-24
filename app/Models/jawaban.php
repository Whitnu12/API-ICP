<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jawaban extends Model
{
    use HasFactory;
    protected $fillable = ['id_siswa', 'id_soal', 'id_pilihan'];
}
