<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $table = 'users';
    
    protected $fillable = [
        'firstname', 'lastname', 'nickname', 'email', 'password'
    ];

    protected $hidden = [
        'remember_token',
    ];


    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
