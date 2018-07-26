<?php

namespace App\Models\Advertisement;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    // 用常量的方式定义支持的广告位允许的展示方式
    const DISPLAY_MODE_TEXT = 'text';
    const DISPLAY_MODE_IMAGE = 'image';

    public static $displayModeMap = [
        self::DISPLAY_MODE_TEXT   => '文字',
        self::DISPLAY_MODE_IMAGE  => '图片',
    ];

    protected $table = "advertisement_positions";
    protected $fillable = [
        'name',
        'description',
        'platform',
        'display_mode',
        'code',
        'extra',
        'remark',
        'status',
    ];

}
