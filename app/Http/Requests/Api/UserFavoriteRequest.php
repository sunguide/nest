<?php

namespace App\Http\Requests\Api;

class UserFavoriteRequest extends FormRequest
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
//                    'target_type' => 'required',
//                    'target_id' => 'required',
                ];
                break;
        }
    }

    public function attributes()
    {
        return [
            'target_type' => '收藏对象类型',
            'target_id' => '收藏对象id',
        ];
    }
}
