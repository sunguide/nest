<?php

namespace App\Transformers;

use App\Models\Store\CartItem;
use App\Models\Store\Product;
use App\Transformers\Store\ProductTransformer;
use League\Fractal\TransformerAbstract;

class CartItemTransformer extends TransformerAbstract
{

    protected $availableIncludes = ['user'];


    public function transform(CartItem $cartItem)
    {
        return [
            'id' => $cartItem->id,
            'user_id' => $cartItem->user_id,
            'product_sku_id' => $cartItem->product_sku_id,
            'product' => $cartItem->product(),
            'amount' => $cartItem->amount,
        ];
    }
    public function includeUser(CartItem $cartItem)
    {
        return $this->primitive($cartItem->user, new UserTransformer());
    }
}
