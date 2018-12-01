<?php

namespace App\Services;

use App\Models\UserSocialite;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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



    public function checkNameAvailable($name){
        $count = User::query()
            ->where('name', $name)
            ->count();
        return $count?false:true;
    }

    public function checkEmailAvailable($email){
        $count = User::query()
            ->where('email', $email)
            ->count();
        return $count?false:true;
    }

    public function getUserBySocialite($driver, $openId){
        $userSocialite = new UserSocialite();
        return $userSocialite->getUser($driver, $openId);
    }


    public function createByOAuth($driver, $userOAuth){
        DB::beginTransaction();
        try{
            $token = $userOAuth->token;
            if(!$token){
                throw new \Exception('token not exist');
            }
            if($this->getUserBySocialite($driver, $userOAuth->id)){
                throw new \Exception('user socialite exist', 400);
            }
            $name = $userOAuth->name;
            if(!$name || !$this->checkNameAvailable($name)){
                $name = $driver . '_' . ($name? $name : $userOAuth->id);
            }
            if(!$this->checkNameAvailable($name)){
                $name .= '_' . str_random(6);
            }
            $email = $userOAuth->email;
            $user = new User(array(
                'name' => $name,
                'email' => $email,
                'avatar' => $userOAuth->avatar,
            ));
            $user->save();

            if($user->id){
                $userSocialite = new UserSocialite();
                $userSocialite->user_id = $user->id;
                $userSocialite->driver = $driver;
                $userSocialite->open_id = $userOAuth->id;
                $userSocialite->access_token = $userOAuth->token;
                $userSocialite->refresh_token = $userOAuth->refreshToken;
                $userSocialite->expires_in = $userOAuth->expiresIn;
                if(!$userSocialite->save()){
                    throw new \Exception('create user socialite fail');
                }
            }else{
                throw new \Exception('create user fail');
            }
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
        return $user;
    }
}
