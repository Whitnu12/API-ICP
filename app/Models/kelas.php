<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kelas extends Model
{
    use HasFactory;
    protected $fillable = ['kelas'];
    protected $primaryKey = 'id_kelas';

    public function mataPelajarans()
    {
        return $this->hasMany(MataPelajaran::class, 'id_kelas');
    }

}
