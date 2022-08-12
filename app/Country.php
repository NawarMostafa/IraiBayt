<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $guarded = [];

    public function cities()
    {
        return $this->hasMany(City::class);
    }
    public function regions()
    {
        return $this->hasMany(Region::class);
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
