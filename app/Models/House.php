<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    const TYPE_APARTMENT = 'apartment';
    const TYPE_VILLA = 'villa';
    const TYPE_HOMESTAY = 'homestay';
    const TYPE_OFFICE = 'office';
    const TYPE_CARPORT = 'carport';

    public static $typeMap = [
        self::TYPE_APARTMENT    => '公寓',
        self::TYPE_VILLA    => '别墅',
        self::TYPE_HOMESTAY => '民宿',
        self::TYPE_OFFICE    => '商铺/写字楼',
        self::TYPE_CARPORT     => '退款失败',
    ];

    const TRADE_SALE = 'sale';
    const TRADE_RENT = 'rent';

    public static $tradeMap = [
        self::TRADE_SALE    => '出售',
        self::TRADE_RENT    => '出租',
    ];

    const PURPOSE_OFFICE = 'office';
    const PURPOSE_LIVE = 'live';
    const PURPOSE_OFFICE_AND_LIVE = 'office_live';

    public static $purposeMap = [
        self::PURPOSE_OFFICE    => '商用',
        self::PURPOSE_LIVE    => '居住',
        self::PURPOSE_OFFICE_AND_LIVE    => '商住两用',
    ];

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
        'user_id',
        'type',
        'trade',
        'purpose',
        'title',
        'description',
        'price',
        'region_id',
        'address',
        'building_no',
        'floor',
        'is_new',
        'features',
        'status',
        'is_new',
        'is_featured',
        'is_approved',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
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

    public function scopeRecentReplied($query)
    {
        // 当话题有新回复时，我们将编写逻辑来更新话题模型的 reply_count 属性，
        // 此时会自动触发框架对数据模型 updated_at 时间戳的更新
        return $query->orderBy('updated_at', 'desc');
    }

    public function scopeRecent($query)
    {
        // 按照创建时间排序
        return $query->orderBy('created_at', 'desc');
    }
}