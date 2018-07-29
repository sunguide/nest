<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Exceptions\CouponCodeUnavailableException;

//广告内容
class AdvertisementItem extends Model
{
    // 用常量的方式定义支持的优惠券类型
    const TYPE_TEXT = 'text';
    const TYPE_IMAGE = 'image';
    const TYPE_VIDEO = 'video';

    public static $typeMap = [
        self::TYPE_TEXT  => '文本',
        self::TYPE_IMAGE => '图片',
        self::TYPE_VIDEO => '视频',
    ];

    protected $fillable = [
        'title',
        'content',
        'type',
        'start_time',
        'end_time',
        'extra',
        'status',
    ];
    protected $casts = [
    ];
    // 指明这两个字段是日期类型
    protected $dates = ['start_time', 'end_time'];

}
