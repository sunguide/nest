<?php

namespace App\Transformers;

use App\Models\Category;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{
    public function transform(Category $category)
    {
        return [
            'id' => $category->id,
            'pid' => intval($category->pid),
            'name' => $category->name,
            'description' => $category->description,
            'alias' => $category->alias
        ];
    }
}
