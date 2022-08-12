<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Depart extends Model
{
    protected $guarded = [];
    protected $casts = [
        'data' => 'array'
    ];
}
