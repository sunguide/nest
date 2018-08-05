<?php

namespace App\Http\Requests\Api;

class FeedbackRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id' => 'required',
            'content' => 'required|min:10',
        ];
    }

    public function attributes()
    {
        return [
            'category_id' => '分类ID',
            'content' => '反馈内容',
        ];
    }}
