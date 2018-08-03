<?php

namespace App\Services;
use App\Models\Advertisement\Position;
use Overtrue\EasySms\EasySms;
use Log;

class SmsService
{
    public function send($phone, EasySms $sms)
    {
        // 生成4位随机数，左侧补0
        $code = str_pad(random_int(1, 999999), 6, 0, STR_PAD_LEFT);
        try {
            $result = $sms->send($phone, [
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
        $result = $sms->send($phone, [
            'content' => "您的验证码{$code}，该验证码5分钟内有效，请勿泄漏于他人！",
            'template' => 'SMS_140680238',
            'data' => [
                'code' => $code
            ]
        ]);
    }
}
