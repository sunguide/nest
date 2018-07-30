<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\InvalidRequestException;
use App\Models\Store\Product;
use App\Transformers\Store\ProductTransformer;
use App\Transformers\Store\ShopTransformer;
use Illuminate\Http\Request;
use App\Models\Store\Shop;
use App\Models\Store\OrderItem;

class ProductsController extends Controller
{
    /**
     * @api {get} /shops/{shop}products 商品列表
     * @apiName getProducts
     * @apiGroup Shop
     *
     * @apiSuccess {Array} 商品列表
     */

    public function index(Request $request)
    {
        // 创建一个查询构造器
        $builder = Product::query()->where('on_sale', true)->where('shop_id','=', $request->shop);
        // 判断是否有提交 search 参数，如果有就赋值给 $search 变量
        // search 参数用来模糊搜索商品
        if ($search = $request->input('search', '')) {
            $like = '%'.$search.'%';
            // 模糊搜索商品标题、商品详情、SKU 标题、SKU描述
            $builder->where(function ($query) use ($like) {
                $query->where('name', 'like', $like);
            });
        }


        $products = $builder->paginate(16);

        return $this->response->paginator($products, new ProductTransformer());
    }

    /**
     * @api {get} /shops/:shop_id/products/:id 获取店铺信息
     * @apiName GetUser
     * @apiGroup Shop
     *
     * @apiParam {Number} id 店铺id
     *
     * @apiSuccess {Object} 店铺信息
     */
    public function show(Product $product, Request $request)
    {
        if (!$product->on_sale) {
            throw new InvalidRequestException('商品已下架');
        }

        $favored = false;
        // 用户未登录时返回的是 null，已登录时返回的是对应的用户对象
        if($user = $request->user()) {
            // 从当前用户已收藏的商品中搜索 id 为当前商品 id 的商品
            // boolval() 函数用于把值转为布尔值
            $favored = boolval($user->favoriteProducts()->find($product->id));
        }
        
        $product = Product::find($product->id);

        $product['favored'] = $favored;
        return $this->response->item($product, new ProductTransformer());

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
