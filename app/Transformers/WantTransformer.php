<?php

namespace App\Transformers;

use App\Models\Want;
use function GuzzleHttp\Psr7\str;
use League\Fractal\TransformerAbstract;

class WantTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['regions', 'user', 'category'];
    protected $defaultIncludes = ['user', 'category'];

    public function transform(Want $want)
    {
        $data = [
            'id' => intval($want->id),
            'user_id' => intval($want->user_id),
            'type' => $want->type,
            'trade' => $want->trade,
            'title' => $want->title,
            'description' => $want->description,
            'budget_min' => $want->budget_min,
            'budget_max' => $want->budget_max,
            'contact_name' => strval($want->contact_name),
            'contact_gender' => strval($want->contact_gender),
            'contact_tel' => strval($want->contact_tel),
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
    public function includeRegions(Want $want){
        if($want->regions){
            return $this->collection($want->regions, new RegionTransformer());
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
