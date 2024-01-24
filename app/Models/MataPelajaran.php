<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    use HasFactory;
    protected $table = 'mata_pelajarans';

    protected $primaryKey = 'id_mapel';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id_guru', 'nama_mapel', 'enroll_code', 'created_by'];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }
}
