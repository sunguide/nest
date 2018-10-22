<?php

namespace App\Transformers;

use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserFavorite;
use App\Transformers\Store\ProductTransformer;
use League\Fractal\TransformerAbstract;

class UserAddressTransformer extends TransformerAbstract
{
    protected $availableIncludes = [];

    protected $defaultIncludes = [];

    public function transform(UserAddress $userAddress)
    {
        return [
            'id' => $userAddress->id,
            'user_id' => $userAddress->user_id,
            'province' => strval($userAddress->province),
            'city' => strval($userAddress->city),
            'district' => strval($userAddress->district),
            'address' => strval($userAddress->address),
            'zip' => strval($userAddress->zip),
            'contact_name' => strval($userAddress->contact_name),
            'contact_phone' => strval($userAddress->contact_phone),
            'last_used_at' => $userAddress->last_used_at,
            'created_at' => $userAddress->created_at->toDateTimeString(),
            'updated_at' => $userAddress->updated_at?$userAddress->updated_at->toDateTimeString():'',
        ];
    }
}
