<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Item;

class ApiUpdata extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:apiupdata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'スタバapiは新商品が発売されると情報が追加される。新商品が追加されているかDBと比較して、差分があればDBに追加する。';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Item $item)
    {
        $client = new \GuzzleHttp\Client();
        $url = 'https://product.starbucks.co.jp/api/category-product-list/beverage/index.json';
        $response = $client->request(
            'GET',
            $url
        );
        $api =  json_decode((string)$response->getBody());
        //apiには配列ですべてのスタバのメニュリストが入っていて、このときにでコードして配列にしている。

        foreach($api as $menuitem){
            $unique = $item->where('product_code', '=', $menuitem->product_code)->first();
	          
            /**=========================
	          *apiの画像パスが結構な頻度で変わってしまうので、laravelのストレージに保存したい
			      $starbucksUrl = "https://product.starbucks.co.jp";
			      $starbucksImagePath = $menuitem->image1;
			      $url = "{$starbucksUrl}{$starbucksImagePath}";
			      
			      $img = file_get_contents($url);
			      $imginfo = pathinfo($url);
            $img_name = $imginfo['basename'];
	          $local_path = Storage::disk("public")//画像の保存先分からん
	          //画像を保存
		        file_put_contents($local_path, $img);
	          dd($url);
	           * ===========================
	          */
            
            
            if(!$unique){//空じゃなければ
              $item->create([
              'product_code' => $menuitem->product_code,
              'product_name' => $menuitem->product_name,
              'category' => $menuitem->category2_list_path,
              'item_img' => $menuitem->image1,
              'product_note' => $menuitem->product_note,
              'price' => $menuitem->price,
	            'catchcopy' => $menuitem->catchcopy,
              'sales_day' => $menuitem->sales_day,
               ]);
             }
        }

       $message = '[' . date('Y-m-d h:i:s') . ']ApiUpdata:' . Item::count();
             //INFOレベルでメッセージを出力
	           $this->info( $message );
		         //ログを書き出す処理はこちら
			       Log::setDefaultDriver('batch');
			       Log::info( $message );


    }
}
