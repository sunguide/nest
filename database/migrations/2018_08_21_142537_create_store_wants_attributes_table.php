<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

//todo 未涉及完成
class CreateStoreWantsAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_wants_attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('shop_id')->index()->comment('店铺id');
            $table->foreign('shop_id')->references('id')->on('store_shops')->onDelete('cascade');
            $table->unsignedInteger('product_id')->index()->comment('商品id');
            $table->foreign('product_id')->references('id')->on('store_products')->onDelete('cascade');
            $table->unsignedInteger('sku_id')->index()->comment('sku id');
            $table->foreign('sku_id')->references('id')->on('store_product_skus')->onDelete('cascade');
            $table->string('name')->comment('属性名');
            $table->string('value')->comment('属性值');
            $table->boolean('is_visible')->comment('是否可视');
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
        Schema::dropIfExists('store_product_attributes');
    }
}
