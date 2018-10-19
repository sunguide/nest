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
            'province' => $userAddress->province,
            'city' => $userAddress->city,
            'district' => $userAddress->district,
            'address' => $userAddress->address,
            'zip' => $userAddress->zip,
            'contact_name' => $userAddress->contact_name,
            'contact_phone' => $userAddress->contact_phone,
            'last_used_at' => $userAddress->last_used_at,
            'created_at' => $userAddress->created_at->toDateTimeString(),
            'updated_at' => $userAddress->updated_at?$userAddress->updated_at->toDateTimeString():'',
        ];
    }
}
