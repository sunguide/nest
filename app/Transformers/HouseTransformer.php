<?php

namespace App\Transformers;

use App\Models\House;
use App\Models\Store\Comment;
use League\Fractal\TransformerAbstract;

class HouseTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['user', 'galleries'];
    protected $defaultIncludes = ['user', 'galleries'];

    public function transform(House $house)
    {
        return [
            'id' => $house->id,
            'user_id' => (int) $house->user_id,
            'type' => strval($house->type),
            'trade' => (int) $house->trade,
            'purpose' => (int) $house->purpose,
            'title' => $house->title,
            'description' => $house->description,
            'price' => $house->price,
            'region_id' => $house->region_id,
            'address' => $house->address,
            'building_no' => $house->building_no,
            'floor' => intval($house->floor),
            'floor_max' => intval($house->floor_max),
            'galleries' =>  $house->galleries ?: [],
            'features' =>  $house->features ?explode(',', $house->features): [],
            'is_new' => floatval($house->is_new),
            'is_featured' => boolval($house->is_featured),
            'is_approved' => boolval($house->is_approved),
            'created_at' => $house->created_at->toDateTimeString(),
            'updated_at' => $house->updated_at->toDateTimeString(),
        ];
    }

    public function includeUser(House $house)
    {
        return $this->primitive($house->user, new UserTransformer());
    }

    public function includeGalleries(House $house)
    {
        return $this->collection($house->galleries, new HouseGalleryTransformer());
    }
}
