<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tugas extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_tugas';
    protected $fillable = ['id_mapel', 'nama_tugas', 'deskripsi_tugas', 'deadline_tugas'];

    public function mapel()
    {
        return $this->belongsTo(MataPelajaran::class, 'id_mapel');
    }
}
