<?php

namespace App\Http\Controllers\Api;

use App\Http\Middleware\VerifyCaptcha;
use App\Models\House;
use App\Models\Store\Shop;
use App\Models\User;
use App\Models\Image;
use App\Models\Want;
use App\Services\UserService;
use App\Transformers\HouseTransformer;
use App\Transformers\Store\ShopTransformer;
use App\Transformers\UserAgentTransformer;
use App\Transformers\WantTransformer;
use Illuminate\Http\Request;
use App\Transformers\UserTransformer;
use App\Http\Requests\Api\UserRequest;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

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
     * @Request({"phone": "18500000000", "password": "******"})
     * @Response(200, body={"data":{"id":1018,"name":"18521527520","phone":"18521527520","email":null,"avatar":null,"introduction":null,"bound_phone":true,"created_at":"2018-09-26 15:12:05","updated_at":"2018-09-26 15:12:05"},"meta":{"access_token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC91c2VycyIsImlhdCI6MTUzNzk3NDcyNSwiZXhwIjoxNTM3OTc4MzI1LCJuYmYiOjE1Mzc5NzQ3MjUsImp0aSI6InJqdldWWHNtSk1yemV0M1MiLCJzdWIiOjEwMTgsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.NtnIOLLbggmquk5nzpdOhy6U7h8CCgx2zQUz0pR1hJM","token_type":"Bearer","expires_in":86400}})
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


    public function show(User $user)
    {
        return $this->response->item($user, new UserTransformer());
    }


    public function update(UserRequest $request)
    {
        $user = $this->user();

        $attributes = $request->only(['name', 'email', 'avatar', 'introduction', 'gender', 'nation', 'local_name', 'languages', 'is_agent']);

        //如果用户名和手机号不一致才允许修改用户名
        if($request->input('name') && $user->name != $user->phone){
            unset($attributes['name']);
        }
        //是否是经纪人只允许修改一次
        if($user->is_agent !== -1){
            unset($attributes['is_agent']);
        }

        if ($request->avatar_image_id) {
            $image = Image::find($request->avatar_image_id);

            $attributes['avatar'] = $image->path;
        }
        if(isset($attributes['languages']) && is_array($attributes['languages'])){
            $attributes['languages'] = implode(',', $attributes['languages']);
        }
        $user->update($attributes);

        return $this->response->item($user, new UserTransformer());
    }

    public function activedIndex(User $user)
    {
        return $this->response->collection($user->getActiveUsers(), new UserTransformer());
    }

    //获取经纪人

    public function agent(User $user){
        return $this->response->item($user, new UserAgentTransformer());
    }

    //获取个人发布
    public function houses(User $user, Request $request){
        $builder = House::query()->where("user_id", $user->id);
        //交易类型
        if($request->input("trade")){
            $builder->where("trade", $request->input("trade"));
        }
        //房屋类型
        if($request->input("type")){
            $builder->where("type", $request->input("type"));
        }
        //日期筛选
        if($request->input("start_date")){
            $builder->where("created_at", '>=', $request->input("start_date"));
        }
        if($request->input("end_date")){
            $builder->where("created_at", '<=', $request->input("end_date"));
        }
        $houses = $builder->paginate($request->input('per_page', 10));
        return $this->response->paginator($houses, new HouseTransformer());
    }

    //获取个人帮住
    public function wants(User $user, Request $request){
        $builder = Want::query()->where("user_id", $user->id);
        //交易类型
        if($request->input("trade")){
            $builder->where("trade", $request->input("trade"));
        }
        //房屋类型
        if($request->input("type")){
            $builder->where("type", $request->input("type"));
        }
        //日期筛选
        if($request->input("start_date")){
            $builder->where("created_at", '>=', $request->input("start_date"));
        }
        if($request->input("end_date")){
            $builder->where("created_at", '<=', $request->input("end_date"));
        }
        $wants = $builder->paginate($request->input('per_page', 10));
        return $this->response->paginator($wants, new WantTransformer());
    }

}
