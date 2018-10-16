<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreWantsAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_wants_attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('want_id')->index()->comment('求购id');
            $table->foreign('want_id')->references('id')->on('store_wants')->onDelete('cascade');
            $table->string('name')->comment('属性名');
            $table->string('value')->comment('属性值');
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
        Schema::dropIfExists('store_wants_attributes');
    }
}
