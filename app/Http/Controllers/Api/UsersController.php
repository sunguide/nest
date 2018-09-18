<?php

namespace App\Http\Controllers\Api;

use App\Http\Middleware\VerifyCaptcha;
use App\Models\User;
use App\Models\Image;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Transformers\UserTransformer;
use App\Http\Requests\Api\UserRequest;
use Illuminate\Foundation\Auth\ResetsPasswords;

/**
 * 注册登录
 *
 * 用户相关接口模块
 *
 * @Resource("users", uri="/users")
 */

class UsersController extends Controller
{
    use ResetsPasswords;
    /**
     *
     *
     * 需要授权
     * @Resource("users", uri="/users")
     */

    /**
     * 用户注册
     *
     * @Post("/")
     * @Versions({"v1"})
     * @Request({"name": "piuio", "password": "******"})
     * @Response(200, body={"access_token": "abc..","token_type": "Bearer","expires_in": 3600})
     */
    public function store(UserRequest $request, UserService $userService)
    {
        $this->middleware(VerifyCaptcha::class);

        if($userService->getByPhone($request->phone)){
            return $this->response->error('用户已经存在', 422);
        }

        $user = User::create([
            'name' => $request->name?:$request->phone,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
        ]);

        // 清除验证码缓存
        \Cache::forget($request->verification_key);

        return $this->response->item($user, new UserTransformer())
            ->setMeta([
                'access_token' => \Auth::guard('api')->fromUser($user),
                'token_type' => 'Bearer',
                'expires_in' => \Auth::guard('api')->factory()->getTTL() * 60
            ])
            ->setStatusCode(201);
    }
    /**
     * 短信验证码登录
     *
     * @Post("/sms/login")
     * @Versions({"v1"})
     * @Request({"phone": "piuio", "verification_key": "foo","verification_code":"1234"})
     * @Response(200, body={"access_token": "abc..","token_type": "Bearer","expires_in": 3600})
     */
    public function smsStore(Request $request, UserService $userService){
        if(!$request->phone){
            return $this->response->error('请输入手机号', 422);
        }
        $this->middleware(VerifyCaptcha::class);
        $user = $userService->getByPhone($request->phone);
        if(!$user){
            $user = User::create([
                'name' => $request->name?:$request->phone,
                'phone' => $request->phone,
                'password' => bcrypt($request->password),
            ]);
        }
        // 清除验证码缓存
        \Cache::forget($request->verification_key);

        return $this->response->item($user, new UserTransformer())
            ->setMeta([
                'access_token' => \Auth::guard('api')->fromUser($user),
                'token_type' => 'Bearer',
                'expires_in' => \Auth::guard('api')->factory()->getTTL() * 60
            ])
            ->setStatusCode(201);
    }


    public function me()
    {
        return $this->response->item($this->user(), new UserTransformer());
    }


    public function update(UserRequest $request)
    {
        $user = $this->user();

        $attributes = $request->only(['name', 'email', 'introduction', 'registration_id']);

        if ($request->avatar_image_id) {
            $image = Image::find($request->avatar_image_id);

            $attributes['avatar'] = $image->path;
        }
        $user->update($attributes);

        return $this->response->item($user, new UserTransformer());
    }

    public function activedIndex(User $user)
    {
        return $this->response->collection($user->getActiveUsers(), new UserTransformer());
    }
}
