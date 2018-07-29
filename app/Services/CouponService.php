<?php

namespace App\Services;

use App\Models\Coupon;
use Auth;
use App\Models\Store\CartItem;

class CouponService
{
    public function get($id)
    {
        return Auth::user()->cartItems()->with(['productSku.product'])->get();
    }

    public function add($data)
    {
        $user = Auth::user();
        // 从数据库中查询该商品是否已经在购物车中
        if ($item = $user->cartItems()->where('product_sku_id', $skuId)->first()) {
            // 如果存在则直接叠加商品数量
            $item->update([
                'amount' => $item->amount + $amount,
            ]);
        } else {
            // 否则创建一个新记录
            $item = new Coupon($data);
            $item->save();
        }

        return $item;
    }

    public function remove($skuIds)
    {
        if (!is_array($skuIds)) {
            $skuIds = [$skuIds];
        }
        Auth::user()->cartItems()->whereIn('product_sku_id', $skuIds)->delete();
    }
}
