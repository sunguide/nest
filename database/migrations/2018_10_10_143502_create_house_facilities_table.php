<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHouseFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house_facilities', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('house_id');
            $table->string('name');
            $table->string('extra')->comment('扩展');
            $table->boolean('is_owned')->default(false)->comment("是否拥有");
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
        Schema::dropIfExists('house_facilities');
    }
}
