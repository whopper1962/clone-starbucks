<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTweetsTable extends Migration
{
    /**
     * Run the migrations.
   ange_cream *
     * @return void
     */
    public function up()
    {
        Schema::create('tweets', function (Blueprint $table) {
        
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('ユーザID');
            $table->unsignedInteger('item_id')->comment('アイテムID');
            $table->string('text')->comment('投稿文章');
            $table->string('cream')->comment('クリーム');
            $table->string('change_cream')->comment('クリーム変更');
            $table->string('powder')->comment('パウダー追加');
            $table->string('milk')->comment('パウダー変更');
            $table->string('ice')->comment('氷変更');
            $table->string('source')->comment('ソース変更');
            $table->softDeletes();
            $table->timestamps();

            $table->index('id');
            $table->index('user_id');
            $table->index('item_id');
            $table->index('text');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
          });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tweets');
    }
}
