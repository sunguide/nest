<?php

namespace App\Models\Store;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
// 商品评价
class ProductReview extends Model
{
    protected $table = "store_product_reviews";
    protected $fillable = ['user_id', 'product_id', 'sku_id', 'content', 'images', 'grade', 'is_anonymous', 'sort'];

    protected $casts = [
        'is_anonymous' => 'boolean', // on_sale 是一个布尔类型的字段
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
