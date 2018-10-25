<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreWantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_wants', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index()->comment("用户id");
            $table->unsignedInteger('category_id')->index()->comment('分类id');
            $table->unsignedInteger('location_id')->index()->comment('城市地址id');
            $table->string('name')->index()->comment('品牌名称');
            $table->integer('deadline')->comment('求购截止时间');
            $table->string('requirement', 500)->comment('货品要求');
            $table->text('specification')->comment('货品要求');
            $table->unsignedInteger('amount')->comment('需要数量');
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
        Schema::dropIfExists('store_wants');
    }
}
