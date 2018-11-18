<?php

namespace App\Transformers;
use App\Models\Region;
use League\Fractal\TransformerAbstract;

class RegionTransformer extends TransformerAbstract
{
    public function transform(Region $region)
    {

        return [
            'id' => $region->id,
            'pid' => intval($region->pid),
            'name' => strval($region->name),
            'level' => $region->level,
            'lat' => $region->lat,
            'lng' => $region->lng,
        ];
    }
}
