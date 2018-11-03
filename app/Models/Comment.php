<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// 商品评价
class Comment extends Model
{
    protected $table = "comments";
    protected $fillable = [
        'user_id',
        'house_id',
        'content',
        'images',
        'grade',
        'is_anonymous',
        'sort'];

    protected $casts = [
        'is_anonymous' => 'boolean', // on_sale 是一个布尔类型的字段
    ];

    public function house()
    {
        return $this->belongsTo(House::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
