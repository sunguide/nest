<?php

namespace App\Http\Requests\Api;

class UserCouponRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'coupon_id' => 'required'
                ];
                break;
        }
    }

    public function attributes()
    {
        return [
            'coupon_id' => '优惠券不存在',
        ];
    }
}
