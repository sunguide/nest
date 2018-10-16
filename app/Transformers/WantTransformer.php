<?php

namespace App\Transformers;

use App\Models\File;
use App\Models\Store\Want;
use League\Fractal\TransformerAbstract;

class WantTransformer extends TransformerAbstract
{
    public function transform(Want $want)
    {
        $data = [
            'id' => $want->id,
            'user_id' => $want->user_id,
            'category_id' => $want->category_id,
            'name' => $want->name,
            'deadline' => $want->deadline,
            'requirement' => $want->requirement,
            'specification' => $want->specification,
            'amount' => $want->amount,
            'introduction' => $want->introduction,
            'is_featured' => $want->is_featured,
            'created_at' => $want->created_at?$want->created_at->toDateTimeString():null,
            'updated_at' => $want->updated_at?$want->updated_at->toDateTimeString():null,
        ];
        //额外属性
        $attributes = $want->attributes()->get();
        if($attributes){
            foreach ($attributes as $attribute){
                $data[$attribute->name] = $attribute->value;
            }
        }
        return $data;
    }
}
