<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{
    protected $guarded = [];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function from()
    {
        return $this->belongsTo(Currancy::class, 'from', 'id');
    }
    public function to()
    {
        return $this->belongsTo(Currancy::class, 'to', 'id');
    }
}
