<?php

namespace App\Transformers;

use App\Models\AdvertisementPosition;
use League\Fractal\TransformerAbstract;

class AdvertisementPositionTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['items'];
    public function transform(AdvertisementPosition $advertisementPosition)
    {
        return [
            'id' => $advertisementPosition->id,
            'name' => $advertisementPosition->name,
            'description' => $advertisementPosition->description,
            'platform' => $advertisementPosition->description,
            'display_mode' => $advertisementPosition->display_mode,
            'code' => $advertisementPosition->code,
            'remark' => $advertisementPosition->remark,
            'extra' => $advertisementPosition->extra,
            'status' => $advertisementPosition->status,
            'created_at' => $advertisementPosition->created_at->toDateTimeString(),
            'updated_at' => $advertisementPosition->updated_at->toDateTimeString(),
            'items' => $advertisementPosition->items
        ];
    }

}
