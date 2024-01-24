<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa'; // Sesuaikan dengan nama tabel yang Anda tentukan

    protected $fillable = ['nis'];
    protected $primaryKey = 'id_siswa';

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
