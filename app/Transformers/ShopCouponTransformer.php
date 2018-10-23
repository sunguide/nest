<?php

namespace App\Transformers;

use App\Models\Coupon;
use App\Models\Store\ShopCoupon;
use App\Models\UserCoupon;
use League\Fractal\TransformerAbstract;

class ShopCouponTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['coupon'];
    protected $defaultIncludes = ['coupon'];

    public function transform(ShopCoupon $shopCoupon)
    {
        return [
            'id' => $shopCoupon->id,
            'shop_id' => $shopCoupon->shop_id,
            'coupon_id' => $shopCoupon->coupon_id,
            'enabled' => true,
            'extra' => $shopCoupon->extra
        ];
    }

    public function includeShop(ShopCoupon $shopCoupon)
    {
        return $this->primitive($shopCoupon->shop, new UserTransformer());
    }

    public function includeCoupon(ShopCoupon $shopCoupon)
    {
        return $this->primitive($shopCoupon->coupon, new CouponTransformer(), 'coupon');
    }
}
