<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Models\User;
use App\Models\UserSocialite;
use Illuminate\Http\Request;
use App\Transformers\DataTransformer;
use App\Http\Requests\Api\AuthorizationRequest;
use App\Http\Requests\Api\SocialAuthorizationRequest;

class AuthorizationsController extends Controller
{
    public function store(AuthorizationRequest $request)
    {
        $username = $request->username;

        filter_var($username, FILTER_VALIDATE_EMAIL) ?
            $credentials['email'] = $username :
            $credentials['phone'] = $username;

        $credentials['password'] = $request->password;
        if (!$token = Auth::guard('api')->attempt($credentials)) {
            return $this->response->errorUnauthorized(trans('auth.failed'));
        }

        return $this->respondWithToken($token)->setStatusCode(201);
    }

    public function socialStore($type, SocialAuthorizationRequest $request, UserSocialite $userSocialite)
    {
        if (!in_array($type, ['weixin'])) {
            return $this->response->errorBadRequest();
        }

        $driver = \Socialite::driver($type);

        try {
            if ($code = $request->code) {
                $response = $driver->getAccessTokenResponse($code);
                $token = array_get($response, 'access_token');
            } else {
                $token = $request->access_token;

                if ($type == 'weixin') {
                    $driver->setOpenId($request->openid);
                }
            }

            $oauthUser = $driver->userFromToken($token);
        } catch (\Exception $e) {
            return $this->response->errorUnauthorized('参数错误，未获取用户信息');
        }

        switch ($type) {
        case 'weixin':
            $unionid = $oauthUser->offsetExists('unionid') ? $oauthUser->offsetGet('unionid') : null;
            $openid = $oauthUser->getId();
            if ($unionid) {
                $userSocialiteData = $userSocialite->getUserByDriverAndUnionId($type, $unionid)->first();
            } else {
                $userSocialiteData = $userSocialite->getUser($type, $openid)->first();
            }

            // 没有用户，默认创建一个用户
            if (!$userSocialiteData) {
                $user = User::create([
                    'name' => $oauthUser->getNickname(),
                    'avatar' => $oauthUser->getAvatar()
                ]);
                if($user){
                    UserSocialite::create([
                        'driver' => $type,
                        'open_id' => $openid,
                        'union_id' => $unionid
                    ]);
                }
            }else{
                $user = User::find($userSocialiteData['id']);
            }

            break;
        }

        $token = Auth::guard('api')->fromUser($user);
        return $this->respondWithToken($token)->setStatusCode(201);
    }

    public function update()
    {
        $token = Auth::guard('api')->refresh();
        return $this->respondWithToken($token);
    }

    public function destroy()
    {
        Auth::guard('api')->logout();
        return $this->response->noContent();
    }

    protected function respondWithToken($token)
    {
        return $this->response->array([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 60
        ]);
    }
}
