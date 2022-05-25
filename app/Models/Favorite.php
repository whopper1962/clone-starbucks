<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    
    public $timestamps = false;

   //イイネしているかどうかの判定
   public function isFavorite(Int $user_id, Int $tweet_id)
   {
       return (boolean) $this->where('user_id', $user_id)->where('tweet_id', $tweet_id)->first();
   }

   //favoriteテーブルのuser_idとtweet_idカラムに追加する。
   //user_idがイイネした人で、tweet_idがイイネ対象の投稿のid
   public function storeFavorite(Int $user_id, Int $tweet_id)
   {
       $this->user_id = $user_id;
       $this->tweet_id = $tweet_id;
       $this->save();

       return;
   }
   
   //いいねのidを探してそいつを削除
   public function destroyFavorite(Int $tweet_id)
   {
      return $this->where('tweet_id', $tweet_id)->delete();
   }
   

}
