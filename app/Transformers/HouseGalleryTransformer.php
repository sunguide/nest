<?php

namespace App\Transformers;

use App\Models\HouseGallery;
use League\Fractal\TransformerAbstract;

class HouseGalleryTransformer extends TransformerAbstract
{
    public function transform(HouseGallery $gallery)
    {
        return [
            'id' => $gallery->id,
            'house_id' => $gallery->house_id,
            'url' => $gallery->url,
            'extra' => $gallery->extra,
            'is_featured' => $gallery->is_featured,
        ];
    }
}
