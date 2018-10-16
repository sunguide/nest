<?php

namespace App\Http\Requests\Api;

class LocateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'lat' => 'required',
            'lng' => 'required',
        ];

        return $rules;
    }

    public function messages()
    {
        return [

        ];
    }
}
