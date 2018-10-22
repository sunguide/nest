<?php

namespace App\Transformers;

use App\Models\Store\CartItem;
use App\Models\Store\Product;
use League\Fractal\TransformerAbstract;

class CartItemTransformer extends TransformerAbstract
{

    protected $availableIncludes = ['user', 'product'];


    public function transform(CartItem $cartItem)
    {
        return [
            'id' => $cartItem->id,
            'user_id' => $cartItem->user_id,
            'product_sku_id' => $cartItem->product_sku_id,
            'amount' => $cartItem->amount,
        ];
    }
    public function includeUser(CartItem $cartItem)
    {
        return $this->item($cartItem->user, new CartItemTransformer());
    }

    public function includeProduct(CartItem $cartItem)
    {
        return $this->item($cartItem->product(), Product::class);
    }


}
