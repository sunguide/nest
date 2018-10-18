<?php

namespace App\Http\Controllers\Api;

use Dingo\Api\Http\Response;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller as BaseController;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Controller extends BaseController
{
    use Helpers;

    public function errorResponse($statusCode, $message=null, $code=0)
    {
        throw new HttpException($statusCode, $message, null, [], $code);
    }

    /**
     * json response
     *
     * @param object|array $data
     * @param int  $status
     * @param array  $headers
     *
     * @return \Dingo\Api\Http\Response
     */
    public function json($data, $status = 200, $meta = null, $headers = []){

        $data = [
            'data' => $data
        ];
        if($meta){
            $data['meta'] = $meta;
        }
        $headers['Content-Type'] = ':application/json';
        return new Response(json_encode($data), $status, $headers);
    }
}
