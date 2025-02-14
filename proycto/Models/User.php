<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'rol'
    ];
}


// <?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Model;

// class User extends Model
// {
//     protected $fillable = [
//         'name',
//         'email',
//         'password',
//         'username',
//         'rol'
//     ];
// }
