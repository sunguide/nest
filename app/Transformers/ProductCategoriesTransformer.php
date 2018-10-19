<?php

namespace App\Transformers;

use App\Models\Store\Categories;
use League\Fractal\TransformerAbstract;

class ProductCategoriesTransformer extends TransformerAbstract
{
    protected $availableIncludes = [];

    public function transform(Categories $category)
    {
        return [
            'id' => $category->id,
            'pid' => $category->pid,
            'shop_id' => $category->shop_id,
            'name' => $category->name
        ];
    }
}
