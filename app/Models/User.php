<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'user';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'user_username',
        'user_email',
        'user_password',
    ];

    protected $hidden = [
        'user_password',
    ];
}
