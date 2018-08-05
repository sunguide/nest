<?php

namespace App\Http\Requests\Api;

class ArticleRequest extends FormRequest
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
            'title' => 'required',
            'content' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'category_id' => '分类ID',
            'title' => '文章标题',
            'content' => '文章内容',
        ];
    }}
