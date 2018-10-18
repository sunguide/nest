<?php

namespace App\Transformers\Store;

use App\Models\Store\Product;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['shop'];
    protected $defaultIncludes = [];

    public function transform(Product $product)
    {
        return [
            'id' => $product->id,
            'category_id' => $product->category_id,
            'shop_id' => $product->shop_id,
            'title' => $product->title,
            'description' => $product->description,
            'image' => $product->image,
            'rating' => $product->rating,
            'sold_count' => $product->sold_count,
            'review_count' => $product->review_count,
            'price' => $product->price,
            'favored' => $product->favored,
            'on_sale' => $product->on_sale,
            'created_at' => $product->created_at->toDateTimeString(),
            'updated_at' => $product->updated_at->toDateTimeString(),
        ];
    }

    public function includeShop(Product $product)
    {
        $item = $this->primitive($product->shop, new ShopTransformer());
        return $item;
    }
}
