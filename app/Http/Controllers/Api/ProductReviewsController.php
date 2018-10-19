<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\InvalidRequestException;
use App\Http\Requests\Api\ProductReviewRequest;
use App\Models\Store\Product;
use App\Models\Store\ProductReview;
use App\Transformers\ProductReviewTransformer;
use Illuminate\Http\Request;
use App\Models\Store\Shop;

class ProductReviewsController extends Controller
{
    /**
     * @api {get} /products/{product}/reviews 商品评价列表
     * @apiName getViews
     * @apiGroup Product
     *
     * @apiSuccess {Array} 商品评价列表
     */

    public function index(Request $request, Product $product)
    {
        $builder = ProductReview::query()->where('product_id', $product->id);

        if($request->order){
            $order = $request->order;
            $orderway = $request->orderway?:"desc";
            $builder = $builder->orderBy($order, $orderway);
        }else{
            $builder = $builder->orderBy("created_at", "desc");
        }

        $reviews = $builder->paginate(10);

        return $this->response->paginator($reviews, new ProductReviewTransformer());
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
     * @apiSuccess {Object} 评价详情
     */
    public function store(ProductReviewRequest $request,Product $product, ProductReview $productReview)
    {
        $productReview->fill($request->all());
        $productReview->product_id = $product->id;
        $productReview->user_id = $this->user()->id;
        $productReview->save();
        return $this->response->item($productReview, new ProductReviewTransformer())->setStatusCode(201);
    }
}
