<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreShopCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_shop_coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('shop_id');
            $table->foreign('shop_id')->references('id')->on('store_shops')->onDelete('cascade');
            $table->unsignedInteger('coupon_id');
            $table->foreign('coupon_id')->references('id')->on('coupons')->onDelete('cascade');
            $table->string('extra',1000)->nullable();
            $table->boolean('enabled')->default(1);
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
        Schema::dropIfExists('store_shop_coupons');
    }
}
