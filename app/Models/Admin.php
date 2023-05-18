<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use Notifiable;
    use HasApiTokens;

    protected $guard = 'admin';

    protected $fillable = [
        'npp', 'email', 'password', 'nama'
    ];

    protected $hidden = [
        'password', 'remember_token','token'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}