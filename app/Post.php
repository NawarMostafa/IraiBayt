<?php

namespace App;

use App\Region;
use App\City;
use App\Favorit;
use Carbon\Carbon;
use App\Comment;
use App\Chat;
use function GuzzleHttp\Psr7\str;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];
    protected $casts = [
        'imgs' => 'array',
        'tags' => 'array',
        'contact' => 'array',
        'more' => 'array'
    ];

    protected $dates = [
        'created_at'
    ];

    protected $attributes = [
        'active' => 'pending'
    ];

    // protected $dispatchesEvents = [
    //     'deleting' => \App\Events\PostDeleting::class,
    // ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function sub()
    {
        return $this->belongsTo(Subcat::class, 'subcat_id');
    }
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function currancy()
    {
        return $this->belongsTo(Currancy::class);
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function getCreatedAtAttribute($v)
    {

        Carbon::setLocale('ar');
        return Carbon::createFromTimestamp(strtotime($v))->diffForHumans();
    }
    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorit::class);
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($post) { // before delete() method call this
            $post->comments()->each(function ($comment) {
                $comment->delete(); // <-- direct deletion
            });

            $post->favorites()->each(function ($favorite) {
                $favorite->delete();
            });

            $post->chats()->each(function ($chat) {
                $chat->delete();
            });
        });
    }
}
