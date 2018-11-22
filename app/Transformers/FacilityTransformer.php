<?php

namespace App\Transformers;

use App\Models\Category;
use App\Models\Facility;
use function GuzzleHttp\Psr7\str;
use League\Fractal\TransformerAbstract;

class FacilityTransformer extends TransformerAbstract
{
    public function transform(Facility $facility)
    {
        return [
            'id' => $facility->id,
            'name' => $facility->name,
            'icon' => strval($facility->icon),
            'disabled' => boolval($facility->disabled),
        ];
    }
}
