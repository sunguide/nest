<?php

namespace App\Models;

use App\Http\Requests\Api\UserFavoriteRequest;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone', 'email', 'password',  'introduction', 'avatar', 'email_verified',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified' => 'boolean',
    ];

    protected $appends = [
        'grade',
    ];


    //
    public function findByPhone(){

    }

    //我的地址
    public function addresses()
    {
        return $this->hasMany(UserAddress::class);
    }

    //我的购物车
    public function cartItems()
    {
        return $this->hasMany(Store\CartItem::class);
    }

    //我的优惠券
    public function coupons()
    {
        return $this->hasMany(UserCoupon::class);
    }

    //是否拥有优惠券
    public function hasCoupon($coupon)
    {
        return UserCoupon::query()->where("user_id", $this->id)->where("coupon_id", $coupon->id)->where("enabled", 1)->first();
    }

    //我的发布的房屋
    public function houses()
    {
        return $this->hasMany(House::class);
    }

    //我的收藏
    public function favorites()
    {
        return $this->hasMany(UserFavorite::class);
    }


    public function favoriteProducts()
    {
        return $this->belongsToMany(Store\Product::class, 'user_favorites')
            ->withTimestamps()
            ->where("user_favorites.target_type=" . Store\Product::class)
            ->orderBy('user_favorites.created_at', 'desc');
    }

    public function favoriteShops()
    {
        return $this->belongsToMany(Store\Product::class, 'user_favorites')
            ->withTimestamps()
            ->where("user_favorites.target_type=" . Store\Shop::class)
            ->orderBy('user_favorites.created_at', 'desc');
    }

    public function getGradeAttribute()
    {
        $count = Comment::query()->where("user_id")->count();
        if($count){
            return Comment::query()->where("user_id")->sum("grade") / $count;
        }
        return 5.0;
    }

    public function setPasswordAttribute($value)
    {
        // 如果值的长度等于 60，即认为是已经做过加密的情况
        if (strlen($value) != 60) {

            // 不等于 60，做密码加密处理
            $value = bcrypt($value);
        }

        $this->attributes['password'] = $value;
    }

    public function setAvatarAttribute($path)
    {
        // 如果不是 `http` 子串开头，那就是从后台上传的，需要补全 URL
        if ( ! starts_with($path, 'http')) {

            // 拼接完整的 URL
            $path = config('app.url') . "/uploads/images/avatars/$path";
        }

        $this->attributes['avatar'] = $path;
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
