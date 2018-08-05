<?php

namespace App\Http\Requests\Api;

class CategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:2',
            'description' => 'required|min:2',
            'alias' => 'required|min:2',
        ];
    }

    public function attributes()
    {
        return [
            'name' => '分类名称',
            'description' => '描述',
            'alias' => '别名',
        ];
    }}
