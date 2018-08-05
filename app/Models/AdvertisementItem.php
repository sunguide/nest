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
        'start_time',
        'end_time'
    ];

    protected static function boot()
    {
        parent::boot();
        // 监听模型创建事件，在写入数据库之前触发
        static::creating(function ($model) {
            // 如果模型的 exta 字段为空
            if (!$model->extra) {
                $model->extra = '{}';
            }
        });
    }
}
