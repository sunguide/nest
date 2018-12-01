<?php

namespace App\Services;
use Overtrue\EasySms\EasySms;
use Log;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class SmsService
{
    protected $_sms;

    protected function getSms(){
        return $this->_sms ?: ($this->_sms = new EasySms(config('sms')));
    }
    // 发送短信入口
    public function send($phone, $params)
    {
        $sms = $this->getSms();
        try {
            if (!app()->environment('production')) {
                return true;
            }
            $result = $sms->send($phone, $params);
            return $result;
        }catch (\GuzzleHttp\Exception\ClientException $exception) {
            $response = $exception->getResponse();
            $result = json_decode($response->getBody()->getContents(), true);
            throw new InternalErrorException($result['msg'] ?? '短信发送异常');
        }
    }

    // 发送注册验证码短信

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

    // 发送找回密码验证码短信
    public function sendVerifyCodeForResetPassword($phone, $code){
        $phone = trim($phone);
        $result = $this->send($phone, [
            'content' => "验证码{$code}，您正在申请重置密码！",
            'template' => 'SMS_151790634',
            'data' => [
                'code' => $code
            ]
        ]);
        if($result){
            return true;
        }
        return false;
    }
}
