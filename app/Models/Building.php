<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

// 大厦或者住宅小区
class Building extends Model
{
    const STATUS_DRAFT = 0;
    const STATUS_PUBLISHED = 1;
    const STATUS_INVALID = 8;
    const STATUS_DELETED = 9;

    public static $statusMap = [
        self::STATUS_DRAFT    => '草稿',
        self::STATUS_PUBLISHED    => '已发布',
        self::STATUS_INVALID    => '无效信息',
        self::STATUS_DELETED    => '已删除',
    ];


    protected $fillable = [
        'region_id',
        'address',
        'floor_max',
        'images',
        'status'
    ];

    public function houses()
    {
        return $this->hasMany(House::class);
    }

    public function galleries()
    {
        return $this->hasMany(HouseGallery::class);
    }


    public function scopeWithOrder($query, $order)
    {
        // 不同的排序，使用不同的数据读取逻辑
        switch ($order) {
            case 'recent':
                $query = $this->recent();
                break;

            default:
                $query = $this->recentReplied();
                break;
        }
        // 预加载防止 N+1 问题
        return $query->with('user', 'house');
    }


    public function scopeRecent($query)
    {
        // 按照创建时间排序
        return $query->orderBy('created_at', 'desc');
    }

    public static function getStatusDesc($purpose)
    {
        return isset(self::$statusMap[$purpose])?self::$statusMap[$purpose]:'未知';
    }

}