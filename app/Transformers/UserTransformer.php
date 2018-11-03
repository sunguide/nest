<?php

namespace App\Transformers;

use App\Models\User;
use function GuzzleHttp\Psr7\str;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['roles'];

    public function transform(User $user)
    {
        return [
            'id' => $user->id,
            'name' => strval($user->name),
            'phone' => strval($user->phone),
            'email' => strval($user->email),
            'avatar' => strval($user->avatar),
            'introduction' => strval($user->introduction),
            'gender' => $user->gender,
            'nation' => strval($user->nation),
            'local_name' => strval($user->local_name),
            'languages' => strval($user->languages),
            'grade' => floatval($user->grade),
//            'bound_wechat' => ($user->weixin_unionid || $user->weixin_openid) ? true : false,
//            'last_actived_at' => $user->last_actived_at->toDateTimeString(),
            'created_at' => $user->created_at->toDateTimeString(),
            'updated_at' => $user->updated_at?$user->updated_at->toDateTimeString():"",
        ];
    }

    public function includeRoles(User $user)
    {
        return $this->primitive($user->roles, new RoleTransformer());
    }
}
