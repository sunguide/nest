<?php

namespace App\Http\Requests\Api;

class CartRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_sku_id' => [
                'required'
            ]
        ];
    }
}
