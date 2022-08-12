<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Post;
use App\User;

class Comment extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    public function getCreatedAtAttribute($v)
    {

        Carbon::setLocale('ar');
        return Carbon::createFromTimestamp(strtotime($v))->diffForHumans();
    }
}
