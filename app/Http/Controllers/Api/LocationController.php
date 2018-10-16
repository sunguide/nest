<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\LocateRequest;
use App\Http\Requests\Request;
use App\Models\Location;
use App\Services\LocationService;

/**
 * 位置定位服务
 *
 * @Resource("location", uri="/location")
 */
class LocationController extends Controller
{
    /**
     * 位置定位服务
     *
     * 获取当前位置城市
     *
     * @Get("/locate")
     * @Versions({"v1"})
     * @Request({"lat": "70", "lng": 60})
     * @Response(200, body={"data":{"id":330100,"pid":330000,"level":2,"lat":30.27,"lng":120.16,"name":"\u676d\u5dde\u5e02","distance":33.735818247644325}})
     */
    public function locate(LocateRequest $request, LocationService $locationService)
    {
        $lat = $request->lat;
        $lng = $request->lng;


        $location = $locationService->locate($lat, $lng);

        return $this->json($location,200);;
    }

    /**
     * 位置定位服务
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
        $locations = Location::query()->where("pid", $pid)->get();
        return $this->json($locations);
    }
}
