<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'product_name', 'catchcopy', 'category', 'product_note', 'item_img', 'product_code','price','sales_day'
    ];

     public $timestamps = false;

    public function getCategory ($category)
    {  
       return Item::where('category',$category)->get();
    }
}
