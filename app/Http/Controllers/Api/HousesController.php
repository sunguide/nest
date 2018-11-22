<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CommentRequest;
use App\Http\Requests\Api\HouseRequest;
use App\Models\Comment;
use App\Models\House;
use App\Models\HouseGallery;
use App\Transformers\CommentTransformer;
use App\Transformers\HouseTransformer;
use Illuminate\Http\Request;

class HousesController extends Controller
{
    /**
     * @api {get} /house/{house}/comments 商品评价列表
     * @apiName getViews
     * @apiGroup Product
     *
     * @apiSuccess {Array} 商品评价列表
     */

    public function index(Request $request, House $house)
    {
        $builder = House::query()->where('status', House::STATUS_PUBLISHED);

        if($request->order){
            $order = $request->order;
            $orderway = $request->orderway?:"desc";
            $builder = $builder->orderBy($order, $orderway);
        }else{
            $builder = $builder->orderBy("created_at", "desc");
        }

        $houses = $builder->paginate(10);

        return $this->response->paginator($houses, new HouseTransformer());
    }

    /**
     * @api {get} /house/comment/:id 获取评价详情
     * @apiName getReview
     * @apiGroup Product
     *
     * @apiParam {Number} id 评价id
     *
     * @apiSuccess {Object} 评价详情
     */
    public function show(House $house)
    {
        return $this->response->item($house, new HouseTransformer());
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
    public function store(HouseRequest $request, House $house)
    {
        $house->fill($request->all());
        $house->user_id = $this->user()->id;
        $house->status = House::STATUS_PUBLISHED;

        $house->save();
        if($house->id && $request->galleries){
            $galleries = explode(",", $request->galleries);
            foreach ($galleries as $k => $url){
                $gallery = new HouseGallery();
                $gallery->house_id = $house->id;
                $gallery->url = $url;
                $gallery->save();
            }
        }
        return $this->response->item($house, new HouseTransformer())->setStatusCode(201);
    }


    public function facilities(){

    }


    public function recommends(Request $request)
    {
        $builder = House::query()->where('status', House::STATUS_PUBLISHED);

        if($request->input("trade")){
            $builder->where("trade", $request->input("trade"));
        }

        $order = $request->input("order", 'is_featured');
        $orderway = $request->orderway?:"desc";
        $builder->orderBy($order, $orderway);

        $houses = $builder->paginate(10);

        return $this->response->paginator($houses, new HouseTransformer());

    }
}
