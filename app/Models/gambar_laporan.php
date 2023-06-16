<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class gambar_laporan extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'path', 'id_laporan'];
    protected $table = 'gambar_laporan';

    public function laporan()
    {
        
        return $this->belongsTo(laporan::class, 'id_laporan');
    
    }
    
}
