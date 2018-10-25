<?php

namespace App\Transformers;

use App\Models\Location;
use League\Fractal\TransformerAbstract;

class LocationTransformer extends TransformerAbstract
{
    public function transform(Location $location)
    {

        return [
            'id' => $location->id,
            'pid' => intval($location->pid),
            'name' => strval($location->name),
            'level' => $location->level,
            'lat' => $location->lat,
            'lng' => $location->lng,
        ];
    }
}
