<?php

namespace App\Models\Store;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class CartItem extends Model
{
    protected $table = "store_cart_items";
    protected $fillable = ['user_id', 'product_sku_id', 'amount'];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return Product::find(ProductSku::find($this->id)->product_id);
    }
}
