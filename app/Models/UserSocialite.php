<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSocialite extends Model
{
    public $guarded = ['id'];

    /**
     * Get user instance by driver and openid.
     *
     * @param  $driver  string
     * @param  $openid  string
     * @return /App/User|null
     */
    public function getUser($driver, $openid)
    {
        $finder =  $this->where([
            'driver' => $driver,
            'open_id' => $openid
        ])->first();

        return $finder ? $finder->user : $finder;
    }

    /**
     * Get user instance by driver and openid.
     *
     * @param  $driver  string
     * @param  $unionid  string
     * @return /App/User|null
     */
    public function getUserByDriverAndUnionId($driver, $unionid)
    {
        $finder =  $this->where([
            'driver' => $driver,
            'union_id' => $unionid
        ])->first();

        return $finder ? $finder->user : $finder;
    }

    /**
     * get related user model.
     *
     * @return /App/User||null
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Save a new record.
     *
     * @param  $userId  integer
     * @param  $driver  string
     * @param  $id  string
     * @return /App/SocialiteUser
     */
    public function saveOne($userId, $driver, $id)
    {
        return $this->create([
            'user_id' => $userId,
            'driver' => $driver,
            'open_id' => $id
        ]);
    }
}
