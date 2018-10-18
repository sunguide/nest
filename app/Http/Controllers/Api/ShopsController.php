<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\InvalidRequestException;
use App\Models\Store\Product;
use App\Transformers\Store\ShopTransformer;
use Illuminate\Http\Request;
use App\Models\Store\Shop;
use App\Models\Store\OrderItem;

class ShopsController extends Controller
{
    /**
     * @api {get} /shops 店铺列表
     * @apiName getShops
     * @apiGroup Shop
     *
     * @apiSuccess {Array} 店铺信息
     */

    public function index(Request $request)
    {
        // 创建一个查询构造器
        $builder = Shop::query()->where('on_sale', true);
        // 判断是否有提交 keywords 参数，如果有就赋值给 $keywords 变量
        // keywords 参数用来模糊搜索店铺
        if ($search = $request->input('keywords', '')) {
            $like = '%'.$search.'%';
            $builder->where(function ($query) use ($like) {
                $query->where('name', 'like', $like);
            });
        }

        // order 参数用来排序
        if ($order = $request->input('order', '')) {
            $order = explode("|",$order);
            $builder = $builder->orderBy($order[0], $order[1]?:'asc');
        }


        $shops = $builder->paginate(10);

        return $this->response->paginator($shops, new ShopTransformer());
    }

    /**
     * @api {get} /shops/:id 获取店铺信息
     * @apiName GetUser
     * @apiGroup Shop
     *
     * @apiParam {Number} id 店铺id
     *
     * @apiSuccess {Object} 店铺信息
     */
    public function show(Shop $shop, Request $request)
    {
        if (!$shop->on_sale) {
            throw new InvalidRequestException('店铺未开业');
        }

        $favored = false;
        // 用户未登录时返回的是 null，已登录时返回的是对应的用户对象
        if($user = $request->user()) {
            // 从当前用户已收藏的商品中搜索 id 为当前商品 id 的商品
            // boolval() 函数用于把值转为布尔值
            $favored = boolval($user->favoriteShops()->find($shop->id));
        }
        
        $products = Product::query()
            ->where('shop_id', $shop->id)
            ->orderBy('created_at', 'desc') // 按评价时间倒序
            ->limit(10) // 取出 10 条
            ->get();

        $shop['favored'] = $favored;
        $shop['products'] = $products;
        return $this->response->item($shop, new ShopTransformer());

    }

    public function favor(Product $product, Request $request)
    {
        $user = $request->user();
        if ($user->favoriteProducts()->find($product->id)) {
            return [];
        }

        $user->favoriteProducts()->attach($product);

        return [];
    }

    public function disfavor(Shop
                             $shop, Request $request)
    {
        $user = $request->user();
        $user->favoriteProducts()->detach($shop);

        return [];
    }

    public function favorites(Request $request)
    {
        $products = $request->user()->favoriteProducts()->paginate(16);

        return view('products.favorites', ['products' => $products]);
    }
}
