<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuildingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house_buildings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('region_id')->comment('区域id');
            $table->string('address')->nullable()->comment('具体地址');
            $table->integer('floor_max')->nullable()->comment('最大楼层');
            $table->text('galleries')->default('')->comment('图片');
            $table->timestamps();

            $table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('house_buildings');
    }
}
