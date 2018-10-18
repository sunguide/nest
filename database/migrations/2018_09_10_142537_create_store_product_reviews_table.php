<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreProductReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_product_reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index()->comment('用户id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('product_id')->index()->comment('商品id');
            $table->foreign('product_id')->references('id')->on('store_products')->onDelete('cascade');
            $table->unsignedInteger('sku_id')->index()->comment('sku id');
            $table->foreign('sku_id')->references('id')->on('store_product_skus')->onDelete('cascade');
            $table->string('content')->comment('评价内容');
            $table->string('images',500)->nullable()->comment('评价图片');
            $table->string('grade')->comment('评分');
            $table->boolean('is_anonymous')->default(false)->comment('是否匿名');
            $table->integer('sort')->comment('排序权重');
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
        Schema::dropIfExists('store_product_reviews');
    }
}
