<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreOrderRefundApplyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_order_refund_apply', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no')->unique();
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->decimal('total_amount');
            $table->string('status')->default(\App\Models\StoreOrder::REFUND_STATUS_APPLIED);
            $table->boolean('reviewed')->default(false);
            $table->dateTime('reviewed_at')->nullable();
            $table->string('ship_status')->default(\App\Models\StoreOrder::SHIP_STATUS_PENDING);
            $table->text('ship_data')->nullable();
            $table->text('remark')->nullable();
            $table->text('extra')->nullable();
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
        Schema::dropIfExists('store_order_refund_apply');
    }
}
