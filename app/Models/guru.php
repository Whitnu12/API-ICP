<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class guru extends Model
{
    use HasFactory;
    protected $fillable = ['nip'];

    protected $primaryKey = 'id_guru';
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}