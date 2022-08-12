<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    protected $guarded=[];
    public function city(){
        return $this->belongsTo(City::class);
    }
}
