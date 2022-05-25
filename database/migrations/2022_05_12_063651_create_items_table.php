<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
        $table->increments('id');
        $table->bigInteger('product_code')->nullable();
        $table->string('product_name')->null()->comment('商品名');
        $table->string('catchcopy')->nullable()->comment('商品キャッチコピー');
        $table->date('sales_day')->nullable()->comment('発売日');
        $table->string('category')->comment('カテゴリ');
        $table->text('product_note')->nullable()->comment('商品詳細');
        $table->string('item_img')->comment('商品画像');
        $table->bigInteger('price')->nullable()->comment('価格');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
