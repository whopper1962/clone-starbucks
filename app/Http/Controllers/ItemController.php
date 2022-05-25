<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;


class ItemController extends Controller
{
    public function index(Item $item)
    {//この処理は使っていない。cronに持たせている。
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
		        if(!$unique){//空じゃなければ
			          $item->create([
				        'product_code' => $menuitem->product_code,
					      'product_name' => $menuitem->product_name,
					      'category' => $menuitem->category2_list_path,
                'item_img' => $menuitem->image1,
		            'product_note' => $menuitem->product_note,
			          'catchcopy' => $menuitem->catchcopy,
			          'price' => $menuitem->price,
				        'sales_day' => $menuitem->sales_day,
				       ]);
			      }
	      }
	      //return $item->get();//更新処理をわけたいので
    }

    public function getItems(Item $item)
    {
        return $item->orderBy('sales_day','desc')->get();
    }
    
    public function getPriceDescItems(Item $item)
    {//値段降順のソート
        return $item->orderBy('price','desc')->get();
    }
    
    public function getPriceAscItems(Item $item)
    {//値段昇順のソート
        return $item->orderBy('price','asc')->get();
    }
    
    public function getCategoryItems(Item $item, Request $request,$category)
    {//カテゴリ別の出力
        return $item->getCategory($category);
    }
}
