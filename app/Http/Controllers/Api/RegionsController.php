<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\LocateRequest;
use App\Http\Requests\Request;
use App\Models\Location;
use App\Models\Region;
use App\Services\LocationService;
use App\Transformers\RegionTransformer;

/**
 * 地区服务
 *
 * @Resource("location", uri="/location")
 */
class RegionsController extends Controller
{
    /**
     * 地区服务
     *
     * 省市区数据
     *
     * @Post("/")
     * @Versions({"v1"})
     * @Request({"pid": "110000"})
     * @Response(200, body={"data":[{"id":110100,"pid":110000,"node":"110000","name":"\u5317\u4eac\u5e02","level":2,"lat":39.9,"lng":39.9}]})
     */
    public function search(Request $request){
        $pid = $request->pid;
        if(!$pid){
            $pid = null;
        }
        $locations = Region::query()->where("pid", $pid)->get();
        return $this->response->collection($locations, new RegionTransformer());
    }
}
