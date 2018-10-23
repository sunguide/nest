<?php

namespace App\Http\Requests\Api;

class ShopCouponRequest extends FormRequest
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
                    'name' => 'required',
//                    'description' => 'required',
                    'type' => 'required',
                    'total' => ['required', 'integer', 'min:1'],
                    'value' => 'required',

                ];
                break;
        }
    }

    public function attributes()
    {
        return [
            'name' => '优惠券名字不能为空',
            'type' => '请选择优惠券类型',
            'total' => '请输入优惠券总数',
            'value' => '请输入优惠券价值',
        ];
    }
}
