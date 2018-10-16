<?php

namespace App\Http\Requests\Api;

class FileRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'file' => 'required',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
              'image.dimensions' => '图片的清晰度不够，宽和高需要 200px 以上',
          ];
    }
}
