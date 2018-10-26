<?php

namespace App\Transformers\Store;

use App\Models\Store\Product;
use App\Models\Store\ProductSku;
use League\Fractal\TransformerAbstract;

class ProductSkuTransformer extends TransformerAbstract
{
    protected $availableIncludes = [];
    protected $defaultIncludes = [];

    public function transform(ProductSku $productSku)
    {
        return [
            'id' => $productSku->id,
            'product_id' => intval($productSku->product_id),
            'title' => strval($productSku->title),
            'description' => strval($productSku->description),
            'image' =>  count($productSku->images) > 0 ? $productSku->images[0] : $productSku->image,
            'images' => $productSku->images,
            'price' => floatval($productSku->price),
            'original_price' => floatval($productSku->original_price),
            'stock' => floatval($productSku->stock),//库存
            'created_at' => $productSku->created_at->toDateTimeString(),
            'updated_at' => $productSku->updated_at->toDateTimeString(),
        ];
    }
}
