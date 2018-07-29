<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name'); //优惠券名称
            $table->string('description');//优惠券描述
            $table->string('channel'); //渠道标识
            $table->string('type');//fixed
            $table->decimal('value');
            $table->unsignedInteger('total');
            $table->unsignedInteger('used')->default(0);
            $table->decimal('min_amount', 10, 2);
            $table->datetime('not_before')->nullable();
            $table->datetime('not_after')->nullable();
            $table->boolean('enabled');
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
        Schema::dropIfExists('coupons');
    }
}
