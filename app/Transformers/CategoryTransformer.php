<?php

namespace App\Transformers;

use App\Models\Category;
use function GuzzleHttp\Psr7\str;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{
    public function transform(Category $category)
    {
        return [
            'id' => $category->id,
            'pid' => intval($category->pid),
            'name' => $category->name,
            'description' => strval($category->description),
            'alias' => strval($category->alias),
            'image' => strval($category->image),
        ];
    }
}
