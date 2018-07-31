<?php

namespace App\Services;

use App\Models\UserFavorite;
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

    public function getFavoritesByUserId($userId){
        $userFavorites = UserFavorite::query()
            ->where('user_id', $userId)
            ->get();
        return $userFavorites;
    }
}
