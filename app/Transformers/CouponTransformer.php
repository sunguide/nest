<?php

namespace App\Transformers;

use App\Models\Coupon;
use League\Fractal\TransformerAbstract;

class CouponTransformer extends TransformerAbstract
{
    protected $availableIncludes = [];

    public function transform(Coupon $coupon)
    {
        return [
            'id' => $coupon->id,
            'name' => $coupon->name,
            'description' => $coupon->description,
            'type' => $coupon->type,
            'value' => $coupon->value,
            'min_amount' => $coupon->min_amount,
            'created_at' => $coupon->created_at->toDateTimeString(),
        ];
    }
}
