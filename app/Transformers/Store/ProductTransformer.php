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
            'category_id' => intval($product->category_id),
            'shop_id' => intval($product->shop_id),
            'title' => strval($product->title),
            'description' => strval($product->description),
            'image' => $product->image,
            'rating' => floatval($product->rating),
            'sold_count' => intval($product->sold_count),
            'review_count' => intval($product->review_count),
            'price' => floatval($product->price),
            'favored' => boolval($product->favored),
            'on_sale' => boolval($product->on_sale),
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
