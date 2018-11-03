<?php

namespace App\Transformers;

use App\Models\User;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class UserAgentTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['roles'];

    public function transform(User $user)
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'phone' => $user->phone,
            'email' => $user->email,
            'avatar' => $user->avatar,
            'introduction' => $user->introduction,
            'gender' => $user->gender,
            'nation' => $user->nation,
            'local_name' => $user->local_name,
            'languages' => $user->languages,
            'join_days' => floor((now()->timestamp - $user->created_at->timestamp) / 86400),
            'monthly_sold_amount' => 11,
            'monthly_rend_amount' => 99,
            'grade' => 4.9,
        ];
    }

    public function includeRoles(User $user)
    {
        return $this->primitive($user->roles, new RoleTransformer());
    }
}
