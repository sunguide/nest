<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('type')->comment('房屋类型:公寓，别墅，民宿');
            $table->string('trade')->comment('交易类型：出售sale，出租rent');
            $table->string('purpose')->comment('用途');
            $table->string('title');
            $table->text('description')->comment('图文详情');
            $table->unsignedInteger('price')->default(0)->comment('价格');
            $table->integer('region_id')->comment('区域id');
            $table->string('address')->comment('具体地址');
            $table->string('building_no')->comment('楼栋号');
            $table->integer('floor')->comment('楼层');
            $table->integer('floor_max')->comment('最大楼层');
            $table->string('features');
            $table->boolean('is_new')->default(false)->comment('是否新房');
            $table->boolean('is_featured')->default(false)->comment('精选');
            $table->boolean('is_approved')->default(false)->comment('审核过的');
            $table->unsignedInteger('status')->default(0)->comment('状态');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('houses');
    }
}