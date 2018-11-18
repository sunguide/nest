<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wants', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index()->comment("用户id");
            $table->string('type')->index()->comment('分类id');
            $table->string('purpose')->index()->comment('用途');
            $table->string('title');
            $table->text('description')->comment('描述');
            $table->unsignedInteger('budget_min')->default(0)->comment('最低预算');
            $table->unsignedInteger('budget_max')->default(0)->comment('最高预算');
            $table->string('region_ids')->comment('区域ids');
            $table->string('address')->comment('具体地址');
            $table->string('contact_name')->comment('联系人姓名');
            $table->string('contact_gender')->comment('联系人性别');
            $table->string('contact_tel')->comment('联系电话');
            $table->string('features')->default('');
            $table->boolean('is_featured')->default(false)->comment('精选');
            $table->boolean('is_approved')->default(false)->comment('审核过的');
            $table->unsignedInteger('status')->default(0)->comment('状态');
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
        Schema::dropIfExists('wants');
    }
}
