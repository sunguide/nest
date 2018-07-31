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
        // 登录
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

        // 需要 token 验证的接口
        $api->group([
            'middleware' => 'api.throttle'
        ], function($api) {
//        $api->group(['middleware' => 'api.auth'], function($api) {
            // 某个用户收藏的商品
            $api->get('users/{user}/favorite/products', 'UserFavoritesController@index');
            // 用户收藏商品
            $api->post('users/{user}/favorite/product/{product}', 'UserFavoritesController@store');
            // 用户取消商品
            $api->delete('users/{user}/favorite/product/{product}', 'UserFavoritesController@destroy');

            // 订单列表
            $api->get('orders', 'OrdersController@index')
                ->name('api.orders.index');
            // 订单详情
            $api->get('orders/{order}', 'OrdersController@show')
                ->name('api.orders.show');
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

