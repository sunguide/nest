<?php

namespace App\Http\Requests\Api;

class LogisticsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'order_id' => 'required|exists:store_orders,id',
            'provide' => 'required',
            'address_id' => 'required|exists:user_addresses,id',
        ];
    }

    public function attributes()
    {
        return [
            'category_id' => '分类ID',
            'content' => '反馈内容',
        ];
    }}
