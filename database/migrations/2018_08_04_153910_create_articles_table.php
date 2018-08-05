<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->default(0);
            $table->unsignedInteger('category_id')->nullable()->default(0);
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            $table->string('cover', 20)->nullable();
            $table->string('title', 200)->nullable();
            $table->string('summary', 200)->nullable();
            $table->longText('content');
            $table->string('source', 200)->nullable()->comment('来源');
            $table->string('source_author', 200)->nullable()->comment('原文作者');
            $table->string('source_url', 200)->nullable()->comment('原文链接');
            $table->integer('weight')->default(0)->index()->comment('权重值');
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('articles');
    }
}
