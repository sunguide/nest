<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_brands', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('category_id')->index()->comment('分类id');
            $table->string('name')->index()->comment('品牌名称');
            $table->string('logo')->comment('品牌logo');
            $table->text('introduction')->comment('品牌介绍');
            $table->boolean('is_featured')->comment('精选');
            $table->integer('sort')->comment('排序');
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
        Schema::dropIfExists('store_brands');
    }
}
