<?php

namespace App\Models\Store;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Model;

class ShopCoupon extends Model
{
    protected $table = "store_shop_coupons";
    protected $fillable = [
        'shop_id',
        'coupon_id',
        'extra',
        'enabled'
    ];
    protected $dates = ['created_at', 'updated_at'];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function scopeRecent($query)
    {
        // 按照创建时间排序
        return $query->orderBy('created_at', 'desc');
    }
}
