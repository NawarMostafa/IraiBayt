<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Post;
use App\User;

class Chat extends Model
{
    protected $guarded = [];
    public function sender()
    {
        return $this->belongsTo(User::class, 'send');
    }

    public function reciver()
    {
        return $this->belongsTo(User::class, 'recive');
    }
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function getCreatedAtAttribute($v)
    {

        Carbon::setLocale('ar');
        return Carbon::createFromTimestamp(strtotime($v))->diffForHumans();
    }
}
