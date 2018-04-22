<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsnewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goodsnews', function (Blueprint $table) {
            $table->increments('id');
            $table->string('shop_name');
            $table->string('shop_img');
            $table->float('shop_rating',8,2);
            $table->smallInteger('brand');
            $table->smallInteger('on_time');
            $table->smallInteger('fengniao');
            $table->smallInteger('bao');
            $table->smallInteger('piao');
            $table->smallInteger('zhun');
            $table->decimal('start_send',10,2);
            $table->decimal('send_cost',10,2);
            $table->string('distance');
            $table->integer('estimate_time');
            $table->string('notice');
            $table->string('discount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goodsnews');
    }
}
