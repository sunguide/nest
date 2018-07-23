<?php

use Illuminate\Database\Seeder;

class StoreShopsSeeder extends Seeder
{
    public function run()
    {
        factory(\App\Models\Store\Shop::class, 20)->create();
    }
}