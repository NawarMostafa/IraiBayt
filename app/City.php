<?php

namespace App;

use App\Post;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\Constraint\Count;

class City extends Model
{
    protected $guarded = [];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public  function regions()
    {
        return $this->hasMany(Region::class);
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
