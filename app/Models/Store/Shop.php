<?php

namespace App\Models\Store;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    const STATUS_PENDING = 'pending';
    const STATUS_APPLIED = 'applied';
    const STATUS_PROCESSING = 'processing';
    const STATUS_SUCCESS = 'success';
    const STATUS_FAILED = 'failed';
    public static $statusMap = [
        self::STATUS_PENDING   => '未认证',
        self::STATUS_APPLIED => '已申请认证',
        self::STATUS_PROCESSING  => '处理中',
        self::STATUS_SUCCESS => '认证通过',
        self::STATUS_FAILED => '认证失败'
    ];
    protected $table = 'store_shops';
    protected $fillable = ['name', 'introduce', 'images', 'on_sale', 'rating', 'view_count', 'favorite_count', 'product_count'];
    protected $casts = [
        'on_sale' => 'boolean', // on_sale 是一个布尔类型的字段
    ];

    public function getImagesAttribute()
    {
        // 如果 images 字段本身就已经是完整的 url 就直接返回
        $images = $this->attributes['images'];
        if($images && is_array($images)){
            foreach ($images as $key => $image){
                if (!Str::startsWith($this->attributes['image'], ['http://', 'https://'])) {
                    $images[$key] = \Storage::disk('public')->url($image);
                }
            }
        }
        return $images;
    }
    public function getLogoUrlAttribute()
    {
        // 如果 image 字段本身就已经是完整的 url 就直接返回
        if (Str::startsWith($this->attributes['logo'], ['http://', 'https://'])) {
            return $this->attributes['logo'];
        }
        return \Storage::disk('public')->url($this->attributes['logo']);
    }
}
