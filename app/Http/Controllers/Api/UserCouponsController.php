<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\CouponCodeUnavailableException;
use App\Http\Requests\Api\UserCouponRequest;
use App\Models\Coupon;
use App\Models\UserCoupon;
use App\Transformers\CouponTransformer;
use App\Transformers\UserCouponTransformer;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;

/**
 *  用户优惠券
 *
 * @Resource("user/coupons", uri="/user/coupons")
 */

class UserCouponsController extends Controller
{
    /**
     * 获取用户优惠券列表
     *
     * @Post("/")
     * @Versions({"v1"})
     * @Response(200, body={"data":[{"id":8,"user_id":1015,"coupon_id":1,"extra":"","enable":null,"coupon":{"data":{"id":1,"name":"5元优惠券","description":"满10减5","type":"fixed","value":"5.00","min_amount":"10.00","created_at":"-0001-11-30 00:00:00"}}}],"meta":{"pagination":{"total":9,"count":9,"per_page":10,"current_page":1,"total_pages":1,"links":[]}}})
     */
    public function index(Request $request)
    {
        $coupons = $request->user()->coupons()->recent()
            ->paginate(10);

        return $this->response->paginator($coupons, new UserCouponTransformer());

    }
    /**
     * 领取优惠券
     *
     * @Post("/")
     * @Versions({"v1"})
     * @Request({"coupon_id": "1"})
     * @Response(200, body={"data":{"id":9,"user_id":1015,"coupon_id":"1","extra":null,"enable":null,"coupon":{"data":{"id":1,"name":"5元优惠券","description":"满10减5","type":"fixed","value":"5.00","min_amount":"10.00","created_at":"-0001-11-30 00:00:00"}}}})
     */
    public function store(UserCouponRequest $request, UserCoupon $userCoupon)
    {
        $userCoupon->fill($request->all());
        $userCoupon->user_id = $this->user()->id;
        $userCoupon->save();

        return $this->response->item($userCoupon, new UserCouponTransformer())
            ->setStatusCode(201);
    }

    /**
     * 查看优惠券
     *
     * @Post("/{coupon_id}")
     * @Versions({"v1"})
     * @Request()
     * @Response(200, body={"data":{"id":1,"name":"5元优惠券","description":"满10减5","type":"fixed","value":"5.00","min_amount":"10.00","created_at":"-0001-11-30 00:00:00"}})
     */

    public function show(Request $request, Coupon $coupon)
    {
        if (!$coupon) {
            throw new CouponCodeUnavailableException('优惠券不存在');
        }

//        $record->checkAvailable($request->user());

        return $this->response->item($coupon, new CouponTransformer());
    }
}