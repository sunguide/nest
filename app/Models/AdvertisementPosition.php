<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Exceptions\CouponCodeUnavailableException;

//广告
class AdvertisementPosition extends Model
{
    // 用常量的方式定义支持的优惠券类型
    const TYPE_TEXT = 'text';
    const TYPE_TEXT_CAROUSEL = 'text_carousel';
    const TYPE_IMAGE = 'image';
    const TYPE_IMAGE_CAROUSEL = 'image_carousel';
    const TYPE_VIDEO = 'video';

    public static $typeMap = [
        self::TYPE_TEXT   => '文字',
        self::TYPE_TEXT_CAROUSEL => '文字轮播',
        self::TYPE_IMAGE => '图片',
        self::TYPE_IMAGE_CAROUSEL => '图片轮播',
        self::TYPE_VIDEO => '视频',
    ];

    protected $fillable = [
        'name',
        'description',
        'platform',
        'display_mode',
        'code',
        'remark',
        'extra',
        'status'
    ];
    protected $casts = [
//        'enabled' => 'boolean',
    ];
}
