<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreOrderItem extends Model
{
    protected $fillable = ['amount', 'price', 'rating', 'review', 'reviewed_at'];
    protected $dates = ['reviewed_at'];
    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(StoreProduct::class);
    }

    public function productSku()
    {
        return $this->belongsTo(StoreProductSku::class);
    }

    public function order()
    {
        return $this->belongsTo(StoreOrder::class);
    }
}
