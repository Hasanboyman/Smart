<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class persons extends Authenticatable
{
    use Notifiable;

    protected $table = 'persons';
    protected $fillable = [
        'full_name',
        'user_id',
        'group',
        'status',
        'gender',
        'birthday',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
