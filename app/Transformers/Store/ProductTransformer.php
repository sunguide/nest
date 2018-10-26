<?php

namespace App\Transformers\Store;

use App\Models\Store\Product;
use App\Models\Store\ProductSku;
use App\Transformers\Transformer;

class ProductTransformer extends Transformer
{
    protected $availableIncludes = ['shop','skus'];
    protected $defaultIncludes = [];

    public function transform(Product $product)
    {
        return [
            'id' => $product->id,
            'category_id' => intval($product->category_id),
            'shop_id' => intval($product->shop_id),
            'title' => strval($product->title),
            'description' => strval($product->description),
            'image' =>  count($product->images) > 0 ? $product->images[0] : $this->image,
            'images' => $product->images,
            'rating' => floatval($product->rating),
            'sold_count' => intval($product->sold_count),
            'review_count' => intval($product->review_count),
            'price' => floatval($product->price),
            'original_price' => floatval($product->original_price),
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

    public function includeSkus(Product $product)
    {
        return $this->collection($product->skus, new ProductSkuTransformer());
    }
}
