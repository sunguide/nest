<?php

namespace App\Transformers;

use App\Models\Coupon;
use App\Models\UserCoupon;
use League\Fractal\TransformerAbstract;

class UserCouponTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['coupon'];
    protected $defaultIncludes = ['coupon'];

    public function transform(UserCoupon $userCoupon)
    {
        return [
            'id' => $userCoupon->id,
            'user_id' => $userCoupon->user_id,
            'coupon_id' => $userCoupon->coupon_id,
            'extra' => $userCoupon->extra,
            'enable' => $userCoupon->enable
        ];
    }

    public function includeUser(UserCoupon $userCoupon)
    {
        return $this->primitive($userCoupon->user, new UserTransformer());
    }

    public function includeCoupon(UserCoupon $userCoupon)
    {
        return $this->primitive($userCoupon->coupon, new CouponTransformer(), 'coupon');
    }
}
