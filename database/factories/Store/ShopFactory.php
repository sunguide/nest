<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Store\Shop::class, function (Faker $faker) {
    $logo = $faker->randomElement([
        "https://lccdn.phphub.org/uploads/images/201806/01/5320/7kG1HekGK6.jpg",
        "https://lccdn.phphub.org/uploads/images/201806/01/5320/1B3n0ATKrn.jpg",
        "https://lccdn.phphub.org/uploads/images/201806/01/5320/r3BNRe4zXG.jpg",
        "https://lccdn.phphub.org/uploads/images/201806/01/5320/C0bVuKB2nt.jpg",
        "https://lccdn.phphub.org/uploads/images/201806/01/5320/82Wf2sg8gM.jpg",
        "https://lccdn.phphub.org/uploads/images/201806/01/5320/nIvBAQO5Pj.jpg",
        "https://lccdn.phphub.org/uploads/images/201806/01/5320/XrtIwzrxj7.jpg",
        "https://lccdn.phphub.org/uploads/images/201806/01/5320/uYEHCJ1oRp.jpg",
        "https://lccdn.phphub.org/uploads/images/201806/01/5320/2JMRaFwRpo.jpg",
        "https://lccdn.phphub.org/uploads/images/201806/01/5320/pa7DrV43Mw.jpg",
    ]);

    return [
        'user_id' => 1,
        'name'        => $faker->word,
        'introduce'   => $faker->sentence,
        'logo'        => $logo,
        'on_sale'      => true,
        'rating'       => $faker->numberBetween(0, 5),
        'product_count'   => 0,
        'view_count' => 1111,
        'rating'       => 0,
    ];
});
