<?php

namespace App\Transformers;

use App\Models\Store\Categories;
use App\Transformers\Store\ProductTransformer;
use League\Fractal\TransformerAbstract;

class ProductCategoriesTransformer extends TransformerAbstract
{
    protected $availableIncludes = [];

    public function transform(Categories $category)
    {
        $data = [
            'id' => $category->id,
            'pid' => intval($category->pid),
            'shop_id' => intval($category->shop_id),
            'name' => strval($category->name),
        ];
        $data['products'] = $category->products();
        return $data;
    }
}
