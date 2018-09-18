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
        $api->post('users/resetPassword', 'ResetPasswordController@reset')
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
        $api->get('categories/{category}/articles', 'ArticlesController@index')
            ->name('api.categories.articles.index');

        // 发布分类文章
        $api->post('categories/{category}/articles', 'ArticlesController@store')
            ->name('api.categories.articles.index');
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
        // 获取店铺列表
        $api->get('store/shops', 'ShopsController@index')
            ->name('api.shops.index');
        // 店铺详情
        $api->get('store/shops/{shop}', 'ShopsController@show')
            ->name('api.shops.show');

        // 获取店铺商品列表
        $api->get('store/shops/{shop}/products', 'ProductsController@index')
            ->name('api.shops.product.index');
        // 店铺详商品情
        $api->get('store/shop/products/{product}', 'ProductsController@show')
            ->name('api.shops.product.show');

        // 店铺优惠券列表
        $api->get('shops/{shop}/coupons', 'ShopCouponsController@index')
            ->name('api.shop.coupons.index');
        // 店铺优惠券详情
        $api->get('shops/{shop}/coupons/{coupon}', 'ShopCouponsController@show')
            ->name('api.shop.coupons.show');


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
            $api->get('orders', 'OrdersController@index')
                ->name('api.orders.index');
            // 创建订单
            $api->post('orders', 'OrdersController@store')
                ->name('api.orders.store');
            // 订单详情
            $api->get('orders/{order}', 'OrdersController@show')
                ->name('api.orders.show');


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


        });
    });

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

        // 需要 token 验证的接口
        $api->group(['middleware' => 'api.auth'], function($api) {
            // 当前登录用户信息
            $api->get('user', 'UsersController@me')
                ->name('api.user.show');
            // 编辑登录用户信息
            $api->patch('user', 'UsersController@update')
                ->name('api.user.update');
            // 图片资源
            $api->post('images', 'ImagesController@store')
                ->name('api.images.store');
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
        });
    });
});

