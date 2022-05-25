<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Tweet;
use App\Models\Image;

class TweetController extends Controller
{
    public function index(Tweet $tweet, $item_id)
    {//ここで、tweetidに紐づくimageをtweetテーブルに突っ込んで返す。
     //新しい配列を作って返す..?

        return Tweet::where('item_id','=',$item_id)->get();
    }

    public function getTweets($tweet_id)
    {
	      return Tweet::find($tweet_id);
    }

    public function getTweetImage($tweet_id)
    {
        return Image::where('tweet_id',$tweet_id)->get();
    }

    public function tweet(Request $request, Tweet $tweet)
    {
    
    //$user = auth()->user();//←ログイン機能ができたら

        // 変更後
        // formDataを使用して、ファイルを取得できるようにした
        // ツイートを作成した後、
        // 画像もデータベースに保存するようにした
        $params = $request->input('kinds');
        // JSON（文字列）で送られてきたオブジェクトを、オブジェクトに直す
        $decoded_params = json_decode($params[0]);

        $new_tweet = Tweet::create([
            'user_id' => 1,
            'item_id' => $decoded_params->itemNameId->id,
            'text' => $decoded_params->text,
            'cream' => $decoded_params->cream,
            'change_cream' => $decoded_params->change_cream,
            'milk' => $decoded_params->milk,
            'powder' => $decoded_params->powder,
            'source' => $decoded_params->source,
            'ice' => $decoded_params->ice,
        ]);

        // ツイート作成後、作成したデータのIDをtweet_idにしてimagesテーブルにデータ追加
        $files = $request->file();
        foreach ($files['file'] as $file) {
            $file_name = $file->getClientOriginalName();
            // ディスク「my_images」のルートに画像を保存
            $image_path = $file->storeAs('/', $file_name, 'my_images');
            Image::create([
                'user_id' => 1,
                'tweet_id' => $new_tweet->id,
                'item_id' => $new_tweet->item_id,
                'image_path' =>  $image_path
            ]);
        }
    
    }

    public function getItem($item_id)
    {//なぜfirst()で取得できないのだろうか
        return Item::where('id','=',$item_id)->get();

    }

    public function postFiles(Request $request)
    {
        $files = request()->file('files');

	      foreach($files as $index => $image){
	          $path = Storage::disk("public")->putFile('file',$image);
		        $imagePath = "/storage/$path";
	      }
    }

    public function getImage(Image $image, $item_id)
    {
	      $imagepath = $image->getTweetImage($item_id);
	      return $imagepath;
    }

}

