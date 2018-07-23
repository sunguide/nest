<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(UserAddressesSeeder::class);
        $this->call(StoreProductsSeeder::class);
        $this->call(CouponCodesSeeder::class);
        $this->call(StoreOrdersSeeder::class);
    }
}
