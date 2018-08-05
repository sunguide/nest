<?php

namespace App\Models;

use App\Models\Advertisement\Position;
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

    const PLATFORM_ALL = 'all';
    const PLATFORM_IOS = 'ios';
    const PLATFORM_ANDROID = 'android';
    const PLATFORM_H5 = 'h5';
    const PLATFORM_WEB = 'web';

    public static $typeMap = [
        self::TYPE_TEXT   => '文字',
        self::TYPE_TEXT_CAROUSEL => '文字轮播',
        self::TYPE_IMAGE => '图片',
        self::TYPE_IMAGE_CAROUSEL => '图片轮播',
        self::TYPE_VIDEO => '视频',
    ];

    public static $platformMap = [
        self::PLATFORM_ALL   => '所有',
        self::PLATFORM_IOS => 'IOS',
        self::PLATFORM_ANDROID => 'Android',
        self::PLATFORM_H5 => 'H5',
        self::PLATFORM_WEB => 'Web',
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
    protected $casts = [];

    protected static function boot()
    {
        parent::boot();
        // 监听模型创建事件，在写入数据库之前触发
        static::creating(function ($model) {
            // 如果模型的 exta 字段为空
            if (!$model->extra) {
                $model->extra = '{}';
            }

            if (!$model->description) {
                $model->description = '';
            }
        });
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }
}
