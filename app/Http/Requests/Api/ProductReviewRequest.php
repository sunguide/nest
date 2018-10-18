<?php

namespace App\Http\Requests\Api;

class ProductReviewRequest extends FormRequest
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
                    'content' => 'required|string',
                    'grade' => 'required|string'
                ];
                break;
        }
    }

    public function attributes()
    {
        return [
            'content' => '评价内容',
            'grade' => '评分'
        ];
    }
}
