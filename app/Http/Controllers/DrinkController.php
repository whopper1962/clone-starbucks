<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Drink;

class DrinkController extends Controller
{
    public function store($tweetId, Request $request, Drink $drink)
    {
        //$user = auth()->user();
	      $is_favorite = $drink->isfavorite(1, $tweetId);

	      if(!$is_favorite){
	          $drink->storeFavorite(1,$tweetId);
	      }
    }

    public function destroy($tweetId, Drink $drink)
    {
        //$user_id = $drink->user_id;

	      //$favorite_id = $drink->id;
	      $is_favorite = $drink->isFavorite(1,$tweetId);

	      if($is_favorite){
	          $drink->destroyFavorite($tweetId);
	      }
    }
}
