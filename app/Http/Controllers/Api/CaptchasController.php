<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Gregwar\Captcha\CaptchaBuilder;
use App\Http\Requests\Api\CaptchaRequest;

/**
 * 图片验证码
 *
 * @Resource("captchas", uri="/captchas")
 */

class CaptchasController extends Controller
{
    /**
     * 图片验证码
     *
     * 获取验证码图片
     *
     * @Post("/")
     * @Versions({"v1"})
     * @Request({"username": "piuio", "password": "******"})
     * @Response(200, body={"access_token": "abc..","token_type": "Bearer","expires_in": 3600})
     */
    public function store(CaptchaRequest $request, CaptchaBuilder $captchaBuilder)
    {
        $key = 'captcha-'.str_random(15);
        $phone = $request->phone;

        $captcha = $captchaBuilder->build();
        $expiredAt = now()->addMinutes(5);
        \Cache::put($key, ['phone' => $phone, 'code' => $captcha->getPhrase()], $expiredAt);

        $result = [
            'captcha_key' => $key,
            'captcha_code' => $captcha->getPhrase(),//debug
            'expired_at' => $expiredAt->toDateTimeString(),
            'captcha_image_content' => $captcha->inline()
        ];

        return $this->response->array(['data' => $result])->setStatusCode(201);
    }
    /**
     * 图片验证码
     *
     * 验证验证码图片
     *
     * @Post("/verify")
     * @Versions({"v1"})
     * @Request({"username": "piuio", "password": "******"})
     * @Response(200, body={"access_token": "abc..","token_type": "Bearer","expires_in": 3600})
     */
    public function verify(Request $request)
    {
        if(!$request->verification_key){
            return $this->response->error('请输入验证码Key', 422);
        }
        if(!$request->verification_code){
            return $this->response->error('请输入验证码', 422);
        }
        $verifyData = \Cache::get($request->verification_key);

        if (!$verifyData) {
            return $this->response->error('验证码已失效', 422);
        }

        if (!hash_equals((string)$verifyData['code'], $request->verification_code)) {
            return $this->response->errorUnauthorized('验证码错误');
        }

        // 清除验证码缓存
        \Cache::forget($request->verification_key);

        $result = [
            'verify_status' => true
        ];

        return $this->response->array(['data' => $result])->setStatusCode(200);
    }
}
