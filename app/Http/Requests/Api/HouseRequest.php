<?php

namespace App\Http\Requests\Api;

class HouseRequest extends FormRequest
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
                    'type' => 'required|string|in:apartment,villa,homestay,office,carport',
                    'trade' => 'required|string|in:rent,sale',
                    'purpose' => 'required|string|in:office,live,office_live',
                    'title' => 'required|string',
                    'description' => 'string',
                    'price' => 'string',
                    'region_id' => 'required|string',
                    'address' => 'string',
                    'building_no' => 'string',
                    'floor' => 'string',
                    'floor_max' => 'string',
                    'features' => 'string',
                    'is_new' => 'string',
                ];
                break;
        }
    }

    public function attributes()
    {
        return [
            'type' => '公寓类型',
            'purpose' => '用途'
        ];
    }
}
