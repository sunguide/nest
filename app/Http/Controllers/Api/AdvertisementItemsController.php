<?php

namespace App\Http\Controllers\Api;

use App\Models\AdvertisementItem;
use App\Models\AdvertisementPosition;
use App\Models\Category;
use App\Transformers\AdvertisementItemTransformer;
use App\Transformers\AdvertisementPositionTransformer;
use Illuminate\Http\Request;

class AdvertisementItemsController extends Controller
{
    public function index($position, AdvertisementItem $advertisementItem)
    {
        $advertisementItems = $advertisementItem->where("position_id", $position)->paginate(10);

        return $this->response->paginator($advertisementItems, new AdvertisementItemTransformer());
    }
}
