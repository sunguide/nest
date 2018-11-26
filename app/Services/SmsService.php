<?php

namespace App\Services;
use Overtrue\EasySms\EasySms;
use Log;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class SmsService
{
    public function send($phone, $params, EasySms $sms)
    {
        try {
            $result = $sms->send($phone, $params);
            return $result;
        }catch (\GuzzleHttp\Exception\ClientException $exception) {
            $response = $exception->getResponse();
            $result = json_decode($response->getBody()->getContents(), true);
            throw new InternalErrorException($result['msg'] ?? '短信发送异常');
        }
    }


    public function sendVerifyCodeForRegister($phone, $code, EasySms $sms){
        $phone = trim($phone, "+");
        $name = 'OhMyNest';
        //国内短信
        if(strpos($phone, '86') === 0){
            $result = $sms->send($phone, [
                'content' => "验证码{$code}，您正在注册成为新用户，感谢您的支持！",
                'template' => 'SMS_151790634',
                'data' => [
                    'code' => $code
                ]
            ]);
        }else{
            //国际短信
            $result = $sms->send($phone, [
                'content' => "{$code} is Your One-Time Password For {$name}",
                'template' => 'SMS_151830177',
                'data' => [
                    'code' => $code,
                    'name' => $name
                ]
            ]);
        }
        if($result){
            return true;
        }
        return false;
    }
}
