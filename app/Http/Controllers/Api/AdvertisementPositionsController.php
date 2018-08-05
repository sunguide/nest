<?php

namespace App\Http\Controllers\Api;

use App\Models\AdvertisementPosition;
use App\Models\Category;
use App\Transformers\AdvertisementPositionTransformer;
use Illuminate\Http\Request;

class AdvertisementPositionsController extends Controller
{
    public function index(AdvertisementPosition $advertisementPosition,Request $request)
    {
        $advertisementPositions = $advertisementPosition->paginate(20);

        return $this->response->paginator($advertisementPositions, new AdvertisementPositionTransformer());
    }

    public function show(AdvertisementPosition $position, Request $request)
    {
        $position->items;
        return $this->response->item($position, new AdvertisementPositionTransformer());
    }
}
