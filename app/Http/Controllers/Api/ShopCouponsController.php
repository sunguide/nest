<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\CouponCodeUnavailableException;
use App\Http\Requests\Api\IRequest;
use App\Http\Requests\Api\ShopCouponRequest;
use App\Http\Requests\Api\UserCouponRequest;
use App\Models\Coupon;
use App\Models\Store\Shop;
use App\Models\Store\ShopCoupon;
use App\Models\UserCoupon;
use App\Transformers\CouponTransformer;
use App\Transformers\ShopCouponTransformer;
use App\Transformers\UserCouponTransformer;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;

/**
 *  店铺优惠券
 *
 * @Resource("shop/coupons", uri="/shop/coupons")
 */

class ShopCouponsController extends Controller
{
    /**
     * 获取店铺优惠券列表
     *
     * @Post("/")
     * @Versions({"v1"})
     * @Response(200, body={"data":{"id":9,"user_id":1015,"coupon_id":"1","extra":null,"enable":null,"coupon":{"data":{"id":1,"name":"5元优惠券","description":"满10减5","type":"fixed","value":"5.00","min_amount":"10.00","created_at":"-0001-11-30 00:00:00"}}}})
     */
    public function index(Shop $shop, IRequest $request)
    {
        $coupons = $shop->coupons()->recent()
            ->paginate(10);
        return $this->response->paginator($coupons, new ShopCouponTransformer());
    }

    /**
     * 发布优惠券
     *
     * @Post("/")
     * @Versions({"v1"})
     * @Request({"coupon_id": "1"})
     * @Response(200, body={"data":{"id":9,"shop_id":1015,"coupon_id":"1","extra":null,"enable":null,"coupon":{"data":{"id":1,"name":"5元优惠券","description":"满10减5","type":"fixed","value":"5.00","min_amount":"10.00","created_at":"-0001-11-30 00:00:00"}}}})
     */
    public function store(ShopCouponRequest $request, Shop $shop, ShopCoupon $shopCoupon, Coupon $coupon)
    {
        $coupon->fill($request->all());
        $coupon->save();

        $shopCoupon->fill($request->all());
        $shopCoupon->coupon_id = $coupon->id;
        $shopCoupon->shop_id = $shop->id;
        $shopCoupon->save();

        return $this->response->item($shopCoupon, new ShopCouponTransformer())
            ->setStatusCode(201);
    }

    /**
     * 查看店铺优惠券
     *
     * @Post("/{coupon_id}")
     * @Versions({"v1"})
     * @Request()
     * @Response(200, body={"data":{"id":1,"name":"5元优惠券","description":"满10减5","type":"fixed","value":"5.00","min_amount":"10.00","created_at":"-0001-11-30 00:00:00"}})
     */

    public function show(Shop $shop, Coupon $coupon)
    {
        if (!$coupon) {
            throw new CouponCodeUnavailableException('优惠券不存在');
        }

//        $record->checkAvailable($request->user());

        return $this->response->item($coupon, new CouponTransformer());
    }
}