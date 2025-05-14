<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;


//....................................................Encrypt with middleware and Decrypt whit Model.........

// class Test extends Model
// {
//     protected $table = 'users';
    
//     protected $fillable = [
//         'firstname', 'lastname', 'nickname', 'email', 'password'
//     ];

//     protected $hidden = [
//         'remember_token',
//     ];


//     protected function casts(): array
//     {
//         return [
//             'email_verified_at' => 'datetime',
//             'password' => 'hashed',
//         ];
//     }

//     public function getFirstnameAttribute($value)
//     {
//         return Crypt::decryptString($value);
//     }

//     public function getLastnameAttribute($value)
//     {
//         return Crypt::decryptString($value);
//     }

//     public function getNicknameAttribute($value)
//     {
//         return Crypt::decryptString($value);
//     }

//     public function getEmailAttribute($value)
//     {
//         return Crypt::decryptString($value);
//     }

// }



// ...................................................Encrypt & Decrypt whit model...........................

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

            'firstname' => 'encrypted',
            'lastname' => 'encrypted',
            'nickname' => 'encrypted',
            'email' => 'encrypted',
        ];
    }
}
