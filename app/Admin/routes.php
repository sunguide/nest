<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {
    $router->get('/', 'HomeController@index');
    $router->get('users', 'UsersController@index');
    $router->get('store/products', 'ProductsController@index');
    $router->get('store/products/create', 'ProductsController@create');
    $router->post('store/products', 'ProductsController@store');
    $router->get('store/products/{id}/edit', 'ProductsController@edit');
    $router->put('store/products/{id}', 'ProductsController@update');
    $router->get('store/orders', 'OrdersController@index')->name('admin.orders.index');
    $router->get('store/orders/{order}', 'OrdersController@show')->name('admin.orders.show');
    $router->post('store/orders/{order}/ship', 'OrdersController@ship')->name('admin.orders.ship');
    $router->post('store/orders/{order}/refund', 'OrdersController@handleRefund')->name('admin.orders.handle_refund');
    $router->get('coupon_codes', 'CouponCodesController@index');
    $router->post('coupon_codes', 'CouponCodesController@store');
    $router->get('coupon_codes/create', 'CouponCodesController@create');
    $router->get('coupon_codes/{id}/edit', 'CouponCodesController@edit');
    $router->put('coupon_codes/{id}', 'CouponCodesController@update');
    $router->delete('coupon_codes/{id}', 'CouponCodesController@destroy');
    //shops
    $router->get('store/shops', 'ShopsController@index');
    $router->get('store/shops/{id}', 'ShopsController@show');
    $router->get('store/shops/{id}/edit', 'ShopsController@edit');
    $router->delete('store/shops/{id}', 'ShopsController@destroy');
    //reviews
    $router->get('store/product/reviews', 'ProductReviewsController@index');
    $router->get('store/product/reviews/{id}', 'ProductReviewsController@show');
    $router->get('store/product/reviews/{id}/edit', 'ProductReviewsController@edit');
    $router->delete('store/product/reviews/{id}', 'ProductReviewsController@destroy');

    //分类管理
    $router->get('categories', 'CategoriesController@index');
    $router->get('categories/{id}', 'CategoriesController@show');
    $router->get('categories/{id}/edit', 'CategoriesController@edit');
    $router->delete('categories/{id}', 'CategoriesController@destroy');

    //需求
    $router->get('wants', 'WantsController@index');
    $router->get('wants/{id}', 'WantsController@show');
    $router->delete('wants/{id}', 'WantsController@destroy');

    //供应
    $router->get('supplies', 'SuppliesController@index');
    $router->get('supplies/{id}', 'SuppliesController@show');
    $router->delete('supplies/{id}', 'SuppliesController@destroy');

    //财务管理
    $router->get('balances', 'BalancesController@index');
    $router->get('balances/{id}', 'WantsController@show');

    //支付系统流水
    $router->get('payments', 'PaymentsController@index');
    $router->get('payments/{id}', 'PaymentsController@show');



    //文章管理
    $router->get('articles', 'ArticlesController@index');
    $router->post('articles', 'ArticlesController@store');
    $router->get('articles/create', 'ArticlesController@create');
    $router->get('articles/{id}', 'ArticlesController@show');
    $router->get('articles/{id}/edit', 'ArticlesController@edit');
    $router->put('articles/{id}', 'ArticlesController@update');
    $router->delete('articles/{id}', 'ArticlesController@destroy');

    //广告位管理
    $router->get('advertisement/positions', 'AdvertisementPositionsController@index');
    $router->post('advertisement/positions', 'AdvertisementPositionsController@store');
    $router->get('advertisement/positions/create', 'AdvertisementPositionsController@create');
    $router->get('advertisement/positions/{id}/edit', 'AdvertisementPositionsController@edit');
    $router->put('advertisement/positions/{id}', 'AdvertisementPositionsController@update');
    $router->delete('advertisement/positions/{id}', 'AdvertisementPositionsController@destroy');

    //广告内容管理
    $router->get('advertisement/items', 'AdvertisementItemsController@index');
    $router->post('advertisement/items', 'AdvertisementItemsController@store');
    $router->get('advertisement/items/create', 'AdvertisementItemsController@create');
    $router->get('advertisement/items/{id}/edit', 'AdvertisementItemsController@edit');
    $router->put('advertisement/items/{id}', 'AdvertisementItemsController@update');
    $router->delete('advertisement/items/{id}', 'AdvertisementItemsController@destroy');


    //房源管理
    $router->get('houses', 'HousesController@index');
    $router->post('houses', 'HousesController@store');
    $router->get('houses/create', 'HousesController@create');
    $router->get('houses/{id}/edit', 'HousesController@edit');
    $router->put('houses/{id}', 'HousesController@update');
    $router->delete('houses/{id}', 'HousesController@destroy');

    //意见反馈
    $router->get('feedback', 'FeedbackController@index');
    $router->delete('feedback/{id}', 'FeedbackController@destroy');


    //地区设置
    $router->get('regions', 'RegionsController@index');
    $router->post('regions', 'RegionsController@store');
    $router->get('regions/create', 'RegionsController@create');
    $router->get('regions/{id}/edit', 'RegionsController@edit');
    $router->put('regions/{id}', 'RegionsController@update');
    $router->delete('regions/{id}', 'RegionsController@destroy');
});