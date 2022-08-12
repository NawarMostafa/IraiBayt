<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reader()
    {
        return $this->belongsTo(User::class, 'user_read');
    }
    public function getCreatedAtAttribute($v)
    {

        Carbon::setLocale('ar');
        return Carbon::createFromTimestamp(strtotime($v))->diffForHumans();
    }
}
