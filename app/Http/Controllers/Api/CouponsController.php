<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\CouponCodeUnavailableException;
use App\Models\Coupon;
use App\Models\CouponCode;
use App\Models\User;
use App\Transformers\CouponTransformer;
use Illuminate\Http\Request;

class CouponsController extends Controller
{
    public function index(User $user,Request $request)
    {
        $coupons = $user->coupons()->recent()
            ->paginate(10);

        return $this->response->paginator($coupons, new CouponTransformer());

    }

    public function show($code, Request $request)
    {
        if (!$record = Coupon::where('code', $code)->first()) {
            throw new CouponCodeUnavailableException('优惠券不存在');
        }

        $record->checkAvailable($request->user());

        return $this->response->item($record, new CouponTransformer());
    }
}