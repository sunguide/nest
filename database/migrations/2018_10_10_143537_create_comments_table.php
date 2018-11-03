<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index()->comment('用户id');
            $table->unsignedInteger('house_id')->index()->comment('房屋id');
            $table->string('content')->comment('评价内容');
            $table->string('images',500)->nullable()->comment('评价图片');
            $table->string('grade')->comment('评分');
            $table->boolean('is_anonymous')->default(false)->comment('是否匿名');
            $table->integer('sort')->default()->comment('排序权重');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('house_id')->references('id')->on('houses')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
