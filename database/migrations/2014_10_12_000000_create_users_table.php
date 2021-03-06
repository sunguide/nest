<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('phone')->nullable();
            $table->string('phone_prefix')->nullable();
            $table->string('email')->default('');
            $table->string('avatar')->default('');
            $table->string('password');
            $table->rememberToken();
            $table->string('languages')->default('');
            $table->string('nation')->default('');
            $table->string('local_name')->default('')->comment('本国姓名');
            $table->tinyInteger('gender')->default(0)->comment("0:未知，1:男，2:女，3：其他");
            $table->tinyInteger('is_agent')->default(-1)->comment("经纪人");
            $table->timestamps();
            $table->unique(['phone', 'email']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
