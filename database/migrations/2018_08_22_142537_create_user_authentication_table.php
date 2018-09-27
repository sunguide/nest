<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAuthenticationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_authentications', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index()->comment('用户id');
            $table->string('type')->comment('认证类型');
            $table->string('name')->nullable()->comment('认证名称');
            $table->string('number')->nullable()->comment('认证号码');
            $table->string('front')->nullable()->comment('正面照');
            $table->string('back')->nullable()->comment('背面照');
            $table->tinyInteger('status')->comment('认证状态');
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
        Schema::dropIfExists('user_authentications');
    }
}
