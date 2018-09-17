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
    $router->get('products', 'ProductsController@index');
    $router->get('products/create', 'ProductsController@create');
    $router->post('products', 'ProductsController@store');
    $router->get('products/{id}/edit', 'ProductsController@edit');
    $router->put('products/{id}', 'ProductsController@update');
    $router->get('orders', 'OrdersController@index')->name('admin.orders.index');
    $router->get('orders/{order}', 'OrdersController@show')->name('admin.orders.show');
    $router->post('orders/{order}/ship', 'OrdersController@ship')->name('admin.orders.ship');
    $router->post('orders/{order}/refund', 'OrdersController@handleRefund')->name('admin.orders.handle_refund');
    $router->get('coupon_codes', 'CouponCodesController@index');
    $router->post('coupon_codes', 'CouponCodesController@store');
    $router->get('coupon_codes/create', 'CouponCodesController@create');
    $router->get('coupon_codes/{id}/edit', 'CouponCodesController@edit');
    $router->put('coupon_codes/{id}', 'CouponCodesController@update');
    $router->delete('coupon_codes/{id}', 'CouponCodesController@destroy');
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

    //意见反馈
    $router->get('feedback', 'FeedbackController@index');
    $router->delete('feedback/{id}', 'FeedbackController@destroy');
});