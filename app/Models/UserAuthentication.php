<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAuthentication extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'name',
        'number',
        'front',
        'back',
        'status',
    ];
    protected $dates = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function add($userId, $type, $name = '', $number = '', $front = '', $back = '')
    {
        return $this->create([
            'user_id' => $userId,
            'type' => $type,
            'name' => $name,
            'number' => $number,
            'front' => $front,
            'back' => $back,
            'status' => 0
        ]);
    }
    //检查是否已经认证过
    public function isVerified($userId = 0, $type = "")
    {
        if(!$userId){
            return $this->status ? true:false;
        }
        $count = UserAuthentication::query()
            ->where('user_id', $userId)
            ->where('type', $type)
            ->where('status', 1)
            ->count();
        if ($count) {
            return true;
        }
        return false;
    }

    public function getVerifiedAuthentications($userId){
        $authenticationItems = UserAuthentication::query()
            ->where('user_id', $userId)
            ->where('status', 1)
            ->get();
        return $authenticationItems;
    }

    public function setVerified($id){
        if($id){
            return $this->find($id)->update("status", 1);
        }
        return false;
    }
}
