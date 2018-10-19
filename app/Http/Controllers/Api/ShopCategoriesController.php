<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\InternalException;
use App\Exceptions\InvalidRequestException;
use App\Http\Requests\Api\ProductCategoryRequest;
use App\Http\Requests\Api\ProductReviewRequest;
use App\Models\Store\Categories;
use App\Models\Store\Product;
use App\Models\Store\ProductReview;
use App\Transformers\ProductCategoriesTransformer;
use App\Transformers\ProductReviewTransformer;
use Illuminate\Http\Request;
use App\Models\Store\Shop;

class ShopCategoriesController extends Controller
{
    /**
     * @api {get} /products/{product}/reviews 商品评价列表
     * @apiName getViews
     * @apiGroup Product
     *
     * @apiSuccess {Array} 商品评价列表
     */

    public function index(Request $request, Shop $shop)
    {
        $builder = Categories::query()->where('shop_id', $shop->id);

        if($request->order){
            $order = $request->order;
            $orderway = $request->orderway?:"desc";
            $builder = $builder->orderBy($order, $orderway);
        }else{
            $builder = $builder->orderBy("created_at", "desc");
        }

        $reviews = $builder->get();

        return $this->response->collection($reviews, new ProductCategoriesTransformer());
    }

    /**
     * @api {get} /product/reviews/:id 获取评价详情
     * @apiName getReview
     * @apiGroup Product
     *
     * @apiParam {Number} id 评价id
     *
     * @apiSuccess {Object} 评价详情
     */
    public function show(ProductReview $review)
    {
        return $this->response->item($review, new ProductReviewTransformer());
    }

    /**
     * @api {get} /products/:id/reviews 创建商品评价
     * @apiName getReview
     * @apiGroup Product
     *
     * @apiParam {String} content 评价内容
     * @apiParam {String} images 评价图片
     * @apiParam {Number} grade 评价等级
     *
     * @apiSuccess {Object} 商品分类
     */
    public function store(ProductCategoryRequest $request,Shop $shop, Categories $category)
    {
        if(!$shop){
            throw new InternalException("请确定店铺");
        }
        $category->fill($request->all());
        $category->shop_id = $shop->id;
        $category->save();
        return $this->response->item($category, new ProductCategoriesTransformer())->setStatusCode(201);
    }


    public function update(ProductCategoryRequest $request, Shop $shop, Categories $category)
    {
        if($category->shop_id != $shop->id){
            throw new InternalException("无权限");
        }
        $category->update($request->all());
        return $this->response->item($category, new ProductCategoriesTransformer());
    }

    public function destroy(Shop $shop, Categories $category)
    {
        if(!$shop){
            throw new InternalException("请确定店铺");
        }
        if(!$category){
            throw new InternalException("请确定分类");
        }
        $category->delete();
        return $this->response->noContent();
    }


}
