<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name', 'description', 'location', 'date', 'hour', 'type', 'tags', 'visible'
    ];
}
