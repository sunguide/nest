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
        $target_type = $request->product ? "product": "shop";
        $request->user()->favorites()->create($request->only([
            'target_type' => $target_type,
            'target_id' => $request->product
        ]));

        return $this->response->noContent();
    }

    public function destroy(UserFavorite $userFavorite)
    {
        $this->authorize('own', $userFavorite);
        $userFavorite->delete();
        return $this->response->noContent();
    }
}
