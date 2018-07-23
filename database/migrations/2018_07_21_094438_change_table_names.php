<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTableNames extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename("cart_items", "store_cart_items");
        Schema::rename("order_items", "store_order_items");
        Schema::rename("orders", "store_orders");
        Schema::rename("products", "store_products");
        Schema::rename("product_skus", "store_product_skus");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename("store_cart_items", "cart_items");
        Schema::rename("store_order_items", "order_items");
        Schema::rename("store_orders", "orders");
        Schema::rename("store_products", "products");
        Schema::rename("store_product_skus", "product_skus");
    }
}
