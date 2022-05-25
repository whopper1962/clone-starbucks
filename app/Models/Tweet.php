<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Tweet extends Model
{
    protected $fillable = [
        'user_id','item_id','text','cream','change_cream','powder','milk','ice','source',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function drinks()
    {
        return $this->hasMany(Dorink::class);
    }
}
