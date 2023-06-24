<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class guru extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'npp', 'email', 'password', 'jabatan', 'foto_profil'];

    protected $primaryKey = 'id_guru';

    public function mataPelajarans()
    {
        return $this->belongsToMany(MataPelajaran::class, 'guru_mata_pelajaran', 'id_guru', 'kode_mapel');
    }
    

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}