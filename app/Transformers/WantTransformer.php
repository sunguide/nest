<?php

namespace App\Transformers;

use App\Models\File;
use App\Models\Store\Want;
use League\Fractal\TransformerAbstract;

class WantTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['location', 'user', 'category'];
    protected $defaultIncludes = ['location', 'user', 'category'];

    public function transform(Want $want)
    {
        $data = [
            'id' => intval($want->id),
            'user_id' => intval($want->user_id),
            'category_id' => intval($want->category_id),
            'location_id' => intval($want->location_id),
            'name' => $want->name,
            'deadline' => intval($want->deadline),
            'requirement' => $want->requirement,
            'specification' => $want->specification,
            'amount' => intval($want->amount),
            'introduction' => $want->introduction,
            'is_featured' => boolval($want->is_featured),
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
    public function includeLocation(Want $want){
        if($want->location){
            return $this->primitive($want->location, new LocationTransformer());
        }
    }

    public function includeUser(Want $want){
        if($want->user){
            return $this->primitive($want->user, new UserTransformer());
        }
    }

    public function includeCategory(Want $want){
        if($want->category){
            return $this->primitive($want->category, new CategoryTransformer());
        }
    }
}
