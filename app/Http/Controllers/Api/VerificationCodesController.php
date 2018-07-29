<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Overtrue\EasySms\EasySms;
use Illuminate\Support\Str;
use App\Http\Requests\Api\VerificationCodeRequest;

class VerificationCodesController extends Controller
{
    public function store(VerificationCodeRequest $request, EasySms $easySms)
    {
        if($request->captcha_key){
            $captchaData = \Cache::get($request->captcha_key);

            if (!$captchaData) {
                return $this->response->error('图片验证码已失效', 422);
            }

            if (!hash_equals(Str::lower($captchaData['code']), Str::lower($request->captcha_code))) {
                // 验证错误就清除缓存
                \Cache::forget($request->captcha_key);
                return $this->response->errorUnauthorized('图片验证码错误');
            }
        }

        $phone = $captchaData['phone'] ?? $request->phone;
        if (!$phone) {
            return $this->response->errorUnauthorized('手机有误');
        }
        $currentDay = now()->format("Ymd");
        $count = \Cache::get("sms_send_count_{$currentDay}_{$phone}");
        if($count && $count >= 5){
            return $this->response->error('今日获取已达到上限', 400);
        }
        if (!app()->environment('production')) {
            $code = '123456';
        } else {
            // 生成4位随机数，左侧补0
            $code = str_pad(random_int(1, 999999), 6, 0, STR_PAD_LEFT);
            try {
                $result = $easySms->send($phone, [
                    'content' => "您的验证码{$code}，该验证码5分钟内有效，请勿泄漏于他人！",
                    'template' => 'SMS_140680238',
                    'data' => [
                        'code' => $code
                    ]
                ]);
            }catch (\GuzzleHttp\Exception\ClientException $exception) {
                $response = $exception->getResponse();
                $result = json_decode($response->getBody()->getContents(), true);
                return $this->response->errorInternal($result['msg'] ?? '短信发送异常');
            }catch (\Exception $exception){
                return $this->response->errorInternal($exception->getMessage() ?? '短信发送异常');
            }
        }

        $key = 'verificationCode_'.str_random(15);
        $expiredAt = now()->addMinutes(10);
        // 缓存验证码 10分钟过期。
        \Cache::put($key, ['phone' => $phone, 'code' => $code], $expiredAt);
        // 清除图片验证码缓存
        \Cache::forget($request->captcha_key);
        //记录当日手机号发送次数
        \Cache::put("sms_send_count_{$currentDay}_{$phone}", $count + 1);
        return $this->response->array([
            'key' => $key,
            'expired_at' => $expiredAt->toDateTimeString(),
        ])->setStatusCode(201);
    }
}
