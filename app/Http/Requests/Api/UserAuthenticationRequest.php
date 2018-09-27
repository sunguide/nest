<?php

namespace App\Http\Requests\Api;

class UserAuthenticationRequest extends FormRequest
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
                //认证类型：实名，企业，资质
                $rules = [
                    'type' => 'required|string|in:identity,company,qualification,field',
                ];
                switch ($this->type){
                    case 'identity':
                        $rules['name'] = 'required|string';
                        $rules['number'] = 'required|string';
                        $rules['front'] = 'required|string';
                        $rules['back'] = 'required|string';
                        break;
                    case 'company':
                        $rules['name'] = 'required|string';
                        $rules['number'] = 'required|string';
                        $rules['front'] = 'required|string';
                        break;
                    case 'qualification':
                        $rules['front'] = 'required|string';
                        break;
                    case 'filed':
                        break;
                }

                break;
        }
        return $rules;
    }
}
