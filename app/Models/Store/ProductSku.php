<?php

namespace App\Models\Store;

use Illuminate\Database\Eloquent\Model;
use App\Exceptions\InternalException;

class ProductSku extends Model
{
    protected $table = "store_product_skus";
    protected $fillable = [
        'product_id',
        'title',
        'description',
        'image',
        'original_price',
        'price',
        'stock'
    ];

    protected $appends = ['images'];


    public function getImagesAttribute(){
        return $this->image ? explode(",", $this->image):[];
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function decreaseStock($amount)
    {
        if ($amount < 0) {
            throw new InternalException('减库存不可小于0');
        }

        return $this->newQuery()->where('id', $this->id)->where('stock', '>=', $amount)->decrement('stock', $amount);
    }

    public function addStock($amount)
    {
        if ($amount < 0) {
            throw new InternalException('加库存不可小于0');
        }
        $this->increment('stock', $amount);
    }
}
