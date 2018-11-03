<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CommentRequest;
use App\Models\Comment;
use App\Models\House;
use App\Transformers\CommentTransformer;
use Illuminate\Http\Request;

class CommentsController extends Controller
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
        $builder = Comment::query()->where('house_id', $house->id);

        if($request->order){
            $order = $request->order;
            $orderway = $request->orderway?:"desc";
            $builder = $builder->orderBy($order, $orderway);
        }else{
            $builder = $builder->orderBy("created_at", "desc");
        }

        $reviews = $builder->paginate(10);

        return $this->response->paginator($reviews, new CommentTransformer());
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
    public function show(Comment $comment)
    {
        return $this->response->item($comment, new CommentTransformer());
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
    public function store(CommentRequest $request, House $house, Comment $comment)
    {
        $comment->fill($request->all());
        $comment->house_id = $house->id;
        $comment->user_id = $this->user()->id;
        $comment->save();
        return $this->response->item($comment, new CommentTransformer())->setStatusCode(201);
    }
}
