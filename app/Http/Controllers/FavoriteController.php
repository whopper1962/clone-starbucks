<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;


class FavoriteController extends Controller
{
    public function store($itemId, Request $request, Favorite $favorite)
    {
        //$user = auth()->user();//ログイン機能ができたら

	      $is_favorite = $favorite->isFavorite(1, $itemId);

        if(!$is_favorite){
	          $favorite->storeFavorite(1,$itemId);
	      }
    }

    public function destroy($itemId, Favorite $favorite)
    {
        //$user_id = $favorite->user_id;

	      //$favorite_id = $favorite->id;
	      $is_favorite = $favorite->isFavorite(1,$itemId);

	      if($is_favorite){
	          $favorite->destroyFavorite($itemId);
	      }
    }
}
