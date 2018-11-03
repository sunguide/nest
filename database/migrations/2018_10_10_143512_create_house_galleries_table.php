<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHouseGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house_galleries', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('house_id');
            $table->string('url')->unique();
            $table->string('extra')->comment('扩展');
            $table->boolean('is_featured')->default(false)->comment("精选");
            $table->timestamps();

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
        Schema::dropIfExists('house_galleries');
    }
}
