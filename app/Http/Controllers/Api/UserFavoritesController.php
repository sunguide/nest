<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\IRequest;
use App\Http\Requests\Api\UserFavoriteRequest;
use App\Http\Resources\User;
use App\Models\UserFavorite;
use App\Services\UserService;
use App\Transformers\UserFavoritesTransformer;
use Illuminate\Http\Request;
use League\Fractal\Manager;
use App\Http\Requests\UserAddressRequest;

class UserFavoritesController extends Controller
{
    public function index(IRequest $request, UserService $userService)
    {
        // 创建一个查询构造器
        $builder = UserFavorite::query()->where('target_type', "=", "product");

        $favorites = $builder->paginate($request->getPageSize());

        return $this->response->paginator($favorites, new UserFavoritesTransformer());
    }

    public function store(UserFavoriteRequest $request)
    {
        $target_type = $request->target_type;
        $target_id = $request->target_id;
        //已经收藏
        if(!$request->user()->favorites()->where('target_type','=', $target_type)
            ->where('target_type','=', $target_type)
            ->where('target_id','=', $target_id)
            ->first()){
            $result = $request->user()->favorites()->create([
                'target_type' => $target_type,
                'target_id' => $target_id
            ]);
            if(!$result){
                return $this->response->error("收藏失败", 500);
            }
        }
        return $this->response->noContent();
    }

    public function destroy(IRequest $request)
    {
        $userId = \Auth::guard('api')->id();
        $target_type = $_GET['target_type'];
        $target_id = $_GET['target_id'];
        $userFavorite = UserFavorite::query()
            ->where('user_id','=', $userId)
            ->where('target_type','=', $target_type)
            ->where('target_id','=', $target_id)
            ->first();
        if($userFavorite){
            $userFavorite->delete();
        }else{
            return $this->response->noContent();
        }
        return $this->response->item($userFavorite, new UserFavoritesTransformer);
    }
}
