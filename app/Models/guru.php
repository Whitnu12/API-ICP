<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class guru extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'NPP', 'email', 'password', 'jabatan', 'foto_profil'];

    public function user()
{
    return $this->belongsTo(User::class);
}
}