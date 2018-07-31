<?php

namespace App\Transformers;

use App\Models\User;
use App\Models\UserFavorite;
use App\Transformers\Store\ProductTransformer;
use League\Fractal\TransformerAbstract;

class UserFavoritesTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['user', 'product'];

    protected $defaultIncludes = [];

    public function transform(UserFavorite $userFavorite)
    {
        return [
            'id' => $userFavorite->id,
            'user_id' => $userFavorite->user_id,
            'target_type' => $userFavorite->target_type,
            'target_id' => $userFavorite->target_id,
            'created_at' => $userFavorite->created_at->toDateTimeString(),
            'updated_at' => $userFavorite->updated_at->toDateTimeString(),
        ];
    }

    public function includeUser(UserFavorite $userFavorite)
    {
        return $this->item($userFavorite->user, new UserTransformer());
    }

    public function includeProduct(UserFavorite $userFavorite)
    {
        if($userFavorite->product){
            return $this->item($userFavorite->product, new ProductTransformer());
        }
    }
}
