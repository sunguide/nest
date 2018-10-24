<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_shops', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('logo')->nullable();
            $table->string('images')->nullable();
            $table->text('introduce');
            $table->string('business_scope', 500)->default('');
            $table->string('address',200)->nullable();
            $table->string('contact')->nullable();
            $table->string('telphone')->nullable();
            $table->string('tags',200)->nullable();
            $table->geometry('position')->nullable();//地理坐标
            $table->boolean('field_certified')->default(false);//实地认证
            $table->boolean('realname_certified')->default(false);//实名认证
            $table->boolean('company_certified')->default(false);//企业坐标
            $table->string('status')->default(\App\Models\Store\Shop::STATUS_PENDING);
            $table->boolean('on_sale')->default(false);
            $table->unsignedInteger('view_count')->default(0);
            $table->unsignedInteger('favorite_count')->default(0);
            $table->unsignedInteger('product_count')->default(0);
            $table->decimal('rating',2, 2)->default(0);
            $table->timestamps();
        });

        Schema::table('store_products', function (Blueprint $table) {
            $table->unsignedInteger('shop_id')->nullable()->after('id');
            $table->foreign('shop_id')->references('id')->on('store_shops')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('store_shops');

        Schema::table('store_products', function (Blueprint $table) {
            $table->dropForeign(['shop_id']);
            $table->dropColumn('shop_id');
        });
    }
}
