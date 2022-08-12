<?php

namespace App;

use App\Post;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $guarded = [];


    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($region) {
            $region->posts()->each(function ($post) {
                $post->delete();
            });
        });
    }
}
