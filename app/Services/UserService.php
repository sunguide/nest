<?php

namespace App\Services;

use Auth;
use App\Models\User;

class UserService
{
    public function get()
    {
        return Auth::user()->get();
    }

    public function getByPhone($phone){
        $user = User::query()
            ->where('phone', $phone)
            ->first();
        return $user;
    }
}
