<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //广告位
        Schema::create('advertisement_positions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 200);
            $table->text('description');
            $table->string('platform',20);//ios,android,h5,web
            $table->string('display_mode'); //文字，图片，轮播
            $table->string('code',200); //js 短代码
            $table->string('remark',200);
            $table->text('extra');
            $table->integer('status');
            $table->timestamps();
        });

        //广告内容项
        Schema::create('advertisement_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('position_id');
            $table->foreign('position_id')->references('id')->on('advertisement_positions')->onDelete('cascade');
            $table->string('title', 200);
            $table->text('content');
            $table->unsignedInteger('start_time');
            $table->unsignedInteger('end_time');
            $table->text('extra');
            $table->integer('status');
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
        Schema::dropIfExists('advertisement_positions');
        Schema::dropIfExists('advertisement_items');
    }
}
