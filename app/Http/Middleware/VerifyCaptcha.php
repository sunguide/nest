<?php

namespace App\Http\Middleware;

use Closure;

class VerifyCaptcha
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!$request->verification_key){
            return response()->json(['message' => '请输入验证码Key'], 422);
        }
        if(!$request->verification_code){
            return response()->json(['message' => '请输入验证码'], 422);
        }
        $verifyData = \Cache::get($request->verification_key);

        if (!$verifyData) {
            return response()->json(['message' => '验证码已失效'], 422);
        }

        if (!hash_equals((string)$verifyData['code'], $request->verification_code)) {
            return response()->json(['message' => '验证码错误'], 422);
        }

        // 清除验证码缓存
//        \Cache::forget($request->verification_key);

        return $next($request);
    }
}
