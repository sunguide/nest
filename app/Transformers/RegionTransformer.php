<?php

namespace App\Transformers;

use App\Models\Location;
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
            'subs' => $this->getSubs($region->id)
        ];
    }

    private function getSubs($id){
        return Region::getSubs($id);
    }
}
