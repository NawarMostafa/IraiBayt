<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materialexchange extends Model
{
    protected $guarded = [];
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function currancy()
    {
        return $this->belongsTo(Currancy::class);
    }
    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
