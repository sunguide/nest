<?php

namespace App\Models\Store;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class CartItem extends Model
{
    protected $table = "store_cart_items";
    protected $fillable = ['amount'];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function productSku()
    {
        return $this->belongsTo(ProductSku::class);
    }
}
