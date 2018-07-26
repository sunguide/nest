<?php

namespace App\Models\Advertisement;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    // 用常量的方式定义支持的优惠券类型
    const DISPLAY_MODE_TEXT = 'text';
    const DISPLAY_MODE_IMAGE = 'image';

    public static $displayModeMap = [
        self::DISPLAY_MODE_TEXT   => '文字',
        self::DISPLAY_MODE_IMAGE  => '图片',
    ];

    protected $table = "advertisement_items";
    protected $fillable = [
        'position_id',
        'title',
        'content',
        'start_time',
        'end_time',
        'extra',
        'status',
    ];
}
