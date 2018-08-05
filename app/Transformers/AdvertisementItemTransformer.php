<?php

namespace App\Transformers;

use App\Models\AdvertisementItem;
use App\Models\AdvertisementPosition;
use League\Fractal\TransformerAbstract;

class AdvertisementItemTransformer extends TransformerAbstract
{
    public function transform(AdvertisementItem $advertisementItem)
    {
        return [
            'id' => $advertisementItem->id,
            'position_id' => $advertisementItem->position_id,
            'title' => $advertisementItem->title,
            'cover' => $advertisementItem->cover,
            'url' => $advertisementItem->url,
            'content' => $advertisementItem->content,
            'start_time' => $advertisementItem->start_time,
            'end_time' => $advertisementItem->end_time,
            'extra' => $advertisementItem->extra,
            'status' => $advertisementItem->status,
//            'created_at' => $advertisementItem->created_at,
//            'updated_at' => $advertisementItem->updated_at,
        ];
    }
}
