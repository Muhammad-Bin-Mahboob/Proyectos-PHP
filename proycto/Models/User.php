<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'rol'
    ];
}

// use Illuminate\Database\Eloquent\Model;

// class User extends Model
// {
//     protected $fillable = [
//         'name',
//         'email',
//         'password',
//         'rol'
//     ];
// }
