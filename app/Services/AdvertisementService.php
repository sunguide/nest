<?php

namespace App\Services;
use App\Models\Advertisement\Position;

class AdvertisementService
{
    public function getPositionItems(Position $position)
    {
        return $position->with(['positionItem.position'])->where('position_id', $position->id)->first();
    }

    public function addPosition($name, $content, $displayMode, $status)
    {
        $position = new Position(['name' => $name, 'content' => $content,
            'display_mode' => $displayMode, 'status' => $status]);
        $position->save();
        return $position;
    }

    public function removePositon($positionIds)
    {
        if (!is_array($positionIds)) {
            $positionIds = [$positionIds];
        }
        $position =  new Position();
        $position->whereIn('product_sku_id', $positionIds)->delete();
    }
}
