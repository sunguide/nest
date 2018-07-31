<?php

namespace App\Http\Requests\Api;

use Illuminate\Http\Request;

class IRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * 获取分页大小,最大不超过100
     * @param $default int 默认大小
     * @param $max int 最大的分页大小
     * @return int
     */
    public function getPageSize($default = 10, $max = 100)
    {
        return max($this->size ? : $default, $max);
    }

}
