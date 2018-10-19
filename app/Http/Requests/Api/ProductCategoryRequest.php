<?php

namespace App\Http\Requests\Api;

class ProductCategoryRequest extends FormRequest
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
                    'name' => 'required|string'
                ];
            case 'PATCH':
                return [
                    'name' => 'required|string'
                ];
                break;
        }
    }

    public function attributes()
    {
        return [
            'name' => '分类名称'
        ];
    }
}
