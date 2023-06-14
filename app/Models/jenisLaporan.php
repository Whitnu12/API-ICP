<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenisLaporan extends Model
{
    use HasFactory;
    protected $table = 'jenis_laporan';

    protected $primaryKey = 'id_jenis';

    protected $fillable = [
        'jenis_laporan'
    ];

    public function laporan()
    {
        return $this->hasMany(laporan::class, 'id_jenis');
    }

    
}
