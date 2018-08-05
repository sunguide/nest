<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logistics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('logistics_no')->unique()->comment('物流单号');
            $table->unsignedInteger('order_id');
            $table->foreign('order_id')->references('id')->on('store_orders')->onDelete('cascade');
            $table->string('provide',100)->comment('物流提供商');
            $table->string('provide_no',100)->index()->comment('物流提供商物流单号');
            $table->decimal('provide_fee')->index()->comment('物流成本费用');
            $table->string('consignee_name', 200)->comment('收货人姓名');
            $table->string('consignee_phone', 20)->comment('收货人电话');
            $table->string('consignee_address', 200)->comment('收货人地址');
            $table->string('consignee_zip', 10)->comment('收货人邮编');

            $table->string('consigner_name', 200)->comment('发货人姓名');
            $table->string('consigner_phone', 20)->comment('发货人电话');
            $table->string('consigner_address', 200)->comment('发货人地址');
            $table->string('consigner_zip', 10)->comment('发货人邮编');

            $table->string('fee', 10)->comment('物流费用');//显示给用户的
            $table->text('extra');
            $table->integer('status')->default(0)->comment('物流状态');
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
        Schema::dropIfExists('logistics');
    }
}
