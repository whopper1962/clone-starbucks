<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'user_id','tweet_id','image_path','item_id'
    ];
    
    public function tweet()
    {
        return $this->belongsTo(Tweet::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTweetImage($item_id)
    {
         return Image::where('item_id', '=', $item_id)->get();
    }

}
