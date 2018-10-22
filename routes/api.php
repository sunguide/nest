<?php

use Illuminate\Http\Request;
use Dingo\Api\Routing\Router;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
//var_dump(new Router());
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api',
    'middleware' => ['bindings']
], function ($api) {

    //公共接口服务
    $api->group([
        'middleware' => 'api.throttle',
        'limit' => config('api.rate_limits.sign.limit'),
        'expires' => config('api.rate_limits.sign.expires'),
    ], function ($api) {

        // 图片验证码
        $api->post('captchas', 'CaptchasController@store')
            ->name('api.captchas.store');
        // 验证图片验证码
        $api->post('captchas/verify', 'CaptchasController@verify')
            ->name('api.captchas.verify');
        // 短信验证码（需要提交图片验证码）
        $api->post('captchas/sms', 'VerificationCodesController@store')
            ->name('api.captchas.sms.store');

        // 短信注册/登录
        $api->post('users/sms/login', 'UsersController@smsStore')
            ->name('api.users.sms.login');
        // 用户注册
        $api->post('users', 'UsersController@store')
            ->name('api.users.store');

        // 第三方登录
        $api->post('authorizations/socials/{social_type}', 'AuthorizationsController@socialStore')
            ->name('api.socials.authorizations.store');
        // 用户登录
        $api->post('authorizations', 'AuthorizationsController@store')
            ->name('api.authorizations.store');
        // 找回密码
        $api->post('users/resetPassword', 'UserResetPasswordController@reset')
            ->name('api.users.resetPassword');
        // 刷新token
        $api->put('authorizations/current', 'AuthorizationsController@update')
            ->name('api.authorizations.update');
        // 删除token
        $api->delete('authorizations/current', 'AuthorizationsController@destroy')
            ->name('api.authorizations.destroy');


        // 分类列表
        $api->get('categories', 'CategoriesController@index')
            ->name('api.categories.index');
        // 分类创建
        $api->post('categories', 'CategoriesController@store')
            ->name('api.categories.store');

        // 反馈列表
        $api->get('feedbacks', 'FeedbacksController@index')
            ->name('api.feedbacks.index');
        // 提交用户反馈
        $api->post('feedbacks', 'FeedbacksController@store')
            ->name('api.feedbacks.store');

        // 获取分类文章列表
        $api->get('articles', 'ArticlesController@index')
            ->name('api.articles.index');
        // 获取分类文章列表
        $api->get('categories/{category}/articles', 'ArticlesController@index')
            ->name('api.categories.articles.index');

        // 发布分类文章
        $api->post('categories/{category}/articles', 'ArticlesController@store')
            ->name('api.categories.articles.index');

        //定位
        $api->get('location/locate', 'LocationController@locate')->name('api.location.locate');
        $api->get('location/search', 'LocationController@search')->name('api.location.search');
    });

    // 广告接口
    $api->group([
        'middleware' => 'api.throttle',
        'limit' => config('api.rate_limits.access.limit'),
        'expires' => config('api.rate_limits.access.expires'),
    ], function ($api) {
        // 获取广告位置列表
        $api->get('advertisement/positions', 'AdvertisementPositionsController@index')
            ->name('api.advertisement.positions.index');
        // 广告位置详情
        $api->get('advertisement/positions/{position}', 'AdvertisementPositionsController@show')
            ->name('api.advertisement.positions.show');

        // 获取广告内容列表
        $api->get('advertisement/positions/{position}/items', 'AdvertisementItemsController@index')
            ->name('api.advertisement.items.index');
    });
    // 商城接口
    $api->group([
        'middleware' => 'api.throttle',
        'limit' => config('api.rate_limits.access.limit'),
        'expires' => config('api.rate_limits.access.expires'),
    ], function ($api) {
        // 游客可以访问的接口

        // 商品分类
        $api->get('categories/product', 'CategoriesController@product')
            ->name('api.categories.product');

        // 搜索店铺
        $api->get('store/shops', 'ShopsController@index')
            ->name('api.shops.index');
        // 店铺详情
        $api->get('store/shops/{shop}', 'ShopsController@show')
            ->name('api.shops.show');
        // 搜索商品
        $api->get('store/products', 'ProductsController@index')
            ->name('api.products.index');

        // 获取店铺分类列表
        $api->get('store/shops/{shop}/categories', 'ShopCategoriesController@index')
            ->name('api.shops.categories.index');

        // 获取店铺商品列表
        $api->get('store/shops/{shop}/products', 'ProductsController@index')
            ->name('api.shops.product.index');
        // 店铺详商品情
        $api->get('store/shop/products/{product}', 'ProductsController@show')
            ->name('api.shops.product.show');

        // 商品评价列表
        $api->get('products/{product}/reviews', 'ProductReviewsController@index')
            ->name('api.products.reviews.index');
        // 商品评价详情
        $api->get('product/reviews/{review}', 'ProductReviewsController@show')
            ->name('api.products.reviews.show');

        // 店铺优惠券列表
        $api->get('shops/{shop}/coupons', 'ShopCouponsController@index')
            ->name('api.shop.coupons.index');
        // 店铺优惠券详情
        $api->get('shops/{shop}/coupons/{coupon}', 'ShopCouponsController@show')
            ->name('api.shop.coupons.show');
        //我想买
        //求购大厅
        $api->get('wants', 'WantsController@index')
            ->name('api.wants.index');
        //新增求购
        $api->post('wants', 'WantsController@store')
            ->name('api.wants.store');
        //查看求购详情
        $api->get('wants/{want}', 'WantsController@show')
            ->name('api.wants.show');
        // 需要 token 验证的接口
        $api->group(['middleware' => 'api.auth'], function($api) {
            // 用户的收藏
            $api->get('user/favorites', 'UserFavoritesController@index');
            // 用户收藏
            $api->post('user/favorites', 'UserFavoritesController@store');
//            $api->post('user/favorite/shop/{shop}', 'UserFavoritesController@storeShop');
//            // 用户收藏商品
//            $api->post('user/favorite/product/{product}', 'UserFavoritesController@storeProduct');
            // 用户取消收藏
            $api->delete('user/favorites', 'UserFavoritesController@destroy');

            // 订单列表
            $api->get('store/orders', 'OrdersController@index')
                ->name('api.store.orders.index');
            // 创建订单
            $api->post('store/orders', 'OrdersController@store')
                ->name('api.store.orders.store');
            // 订单详情
            $api->get('store/orders/{order}', 'OrdersController@show')
                ->name('api.store.orders.show');


            // 我的优惠券列表
            $api->get('user/coupons', 'UserCouponsController@index')
                ->name('api.user.coupons.index');
            // 领取店铺优惠券
            $api->post('user/coupons', 'UserCouponsController@store')
                ->name('api.user.coupons.show');
            // 我的优惠券详情
            $api->get('user/coupons/{coupon}', 'UserCouponsController@show')
                ->name('api.user.coupons.show');

            // 发布店铺优惠券
            $api->post('shops/{shop}/coupons', 'ShopCouponsController@store')
                ->name('api.shop.coupons.show');

            // 新增商品评价
            $api->post('products/{product}/reviews', 'ProductReviewsController@store')
                ->name('api.products.reviews.store');

            // 新增店铺分类
            $api->post('store/shops/{shop}/categories', 'ShopCategoriesController@store')
                ->name('api.shops.categories.store');
            // 更新店铺分类
            $api->patch('store/shops/{shop}/categories/{category}', 'ShopCategoriesController@update')
                ->name('api.shops.categories.update');
            // 删除店铺分类
            $api->delete('store/shops/{shop}/categories/{category}', 'ShopCategoriesController@destroy')
                ->name('api.shops.categories.destroy');

            // 加入购物车
            $api->post('store/cart/products', 'ShopCategoriesController@store')
                ->name('api.store.cart.products.store');
            // 更新购物车商品
            $api->patch('store/shops/{shop}/categories/{category}', 'ShopCategoriesController@update')
                ->name('api.shops.categories.update');
            // 移除购物车
            $api->delete('store/shops/{shop}/categories/{category}', 'ShopCategoriesController@destroy')
                ->name('api.shops.categories.destroy');

        });
    });

    //用户接口+其他
    $api->group([
        'middleware' => 'api.throttle',
        'limit' => config('api.rate_limits.access.limit'),
        'expires' => config('api.rate_limits.access.expires'),
    ], function ($api) {
        // 游客可以访问的接口
        $api->get('categories', 'CategoriesController@index')
            ->name('api.categories.index');
        // 话题列表
        $api->get('topics', 'TopicsController@index')
            ->name('api.topics.index');
        // 话题详情
        $api->get('topics/{topic}', 'TopicsController@show')
            ->name('api.topics.show');
        // 某个用户发布的话题
        $api->get('users/{user}/topics', 'TopicsController@userIndex')
            ->name('api.users.topics.index');
        // 话题回复列表
        $api->get('topics/{topic}/replies', 'RepliesController@index')
            ->name('api.topics.replies.index');
        // 某个用户的回复列表
        $api->get('users/{user}/replies', 'RepliesController@userIndex')
            ->name('api.users.replies.index');
        // 资源推荐
        $api->get('links', 'LinksController@index')
            ->name('api.links.index');
        // 活跃用户
        $api->get('actived/users', 'UsersController@activedIndex')
            ->name('api.actived.users.index');
        // 当前用户信息
        $api->get('users/{user}', 'UsersController@show')
            ->name('api.users.show');


        // 需要 token 验证的接口
        $api->group(['middleware' => 'api.auth'], function($api) {

            // 当前登录用户信息
            $api->get('user', 'UsersController@me')
                ->name('api.user.show');
            // 编辑登录用户信息
            $api->patch('user', 'UsersController@update')
                ->name('api.user.update');
            // 获取我的用户认证
            $api->get('user/authentication', 'UserAuthenticationController@index')->name('api.user.authentication.index');
            // 提交我的用户认证
            $api->post('user/authentication', 'UserAuthenticationController@store')->name('api.user.authentication.store');

            // 图片资源
            $api->post('images', 'ImagesController@store')
                ->name('api.images.store');
            // 普通文件资源
            $api->post('files', 'FilesController@store')
                ->name('api.files.store');
            // 发布话题
            $api->post('topics', 'TopicsController@store')
                ->name('api.topics.store');
            // 修改话题
            $api->patch('topics/{topic}', 'TopicsController@update')
                ->name('api.topics.update');
            // 删除话题
            $api->delete('topics/{topic}', 'TopicsController@destroy')
                ->name('api.topics.destroy');
            $api->get('user/topics', 'TopicsController@myIndex')
                ->name('api.user.topics.index');
            // 发布回复
            $api->post('topics/{topic}/replies', 'RepliesController@store')
                ->name('api.topics.replies.store');
            // 删除回复
            $api->delete('topics/{topic}/replies/{reply}', 'RepliesController@destroy')
                ->name('api.topics.replies.destroy');
            // 通知列表
            $api->get('user/notifications', 'NotificationsController@index')
                ->name('api.user.notifications.index');
            // 通知统计
            $api->get('user/notifications/stats', 'NotificationsController@stats')
                ->name('api.user.notifications.stats');
            // 标记消息通知为已读
            $api->patch('user/read/notifications', 'NotificationsController@read')
                ->name('api.user.notifications.read');
            // 当前登录用户权限
            $api->get('user/permissions', 'PermissionsController@index')
                ->name('api.user.permissions.index');
            // 获取用户收货地址
            $api->get('users/{user}/addresses', 'UserAddressesController@index')->name('api.users.addresses.index');
            // 新增用户收货地址
            $api->post('users/{user}/addresses', 'UserAddressesController@store')->name('api.users.addresses.index');
            // 修改用户收货地址
            $api->patch('users/{user}/addresses/{address}', 'UserAddressesController@update')->name('api.users.addresses.update');
            // 删除用户收货地址
            $api->delete('users/{user}/addresses/{address}', 'UserAddressesController@destroy')->name('api.users.addresses.destroy');
        });
    });
});

