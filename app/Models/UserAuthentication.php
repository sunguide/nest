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


    const STATUS_PENDING = 0;
    const STATUS_APPLIED = 1;
    const STATUS_PROCESSING = 2;
    const STATUS_SUCCESS = 3;
    const STATUS_FAILED = 4;
    public static $statusMap = [
        self::STATUS_PENDING   => '未认证',
        self::STATUS_APPLIED => '已申请认证,待审核',
        self::STATUS_PROCESSING  => '处理中',
        self::STATUS_SUCCESS => '认证通过',
        self::STATUS_FAILED => '认证失败'
    ];

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
            ->where('status', self::STATUS_SUCCESS)
            ->count();
        if ($count) {
            return true;
        }
        return false;
    }

    public function getVerifiedAuthentications($userId){
        $authenticationItems = UserAuthentication::query()
            ->where('user_id', $userId)
            ->where('status', self::STATUS_SUCCESS)
            ->get();
        return $authenticationItems;
    }

    public function getAuthentications($userId){
        $authenticationItems = UserAuthentication::query()
            ->where('user_id', $userId)
            ->get();
        return $authenticationItems;
    }

    public function setVerified($id){
        if($id){
            return $this->find($id)->update("status", self::STATUS_SUCCESS);
        }
        return false;
    }

    public function getStatusDesc($status){
        if(static::$statusMap[$status]){
            return static::$statusMap[$status];
        }
        return "未知";
    }
}
