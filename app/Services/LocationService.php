<?php

namespace App\Services;
use App\Models\Location;
use Illuminate\Support\Facades\DB;
use Log;

class LocationService
{
    /**
     * 定位到最近的城市
     *
     * @param $lat float 经度
     * @param $lng float 维度
     * @param $distance int 距离 默认100公里
     * @return object
     */
    public function locate($lat, $lng, $distance = 1000)
    {
        $sql = "SELECT id,pid,level,lat,lng,`name`, (
                    6371 * acos (
                        cos ( radians($lat) )
                        * cos( radians( lat ) )
                        * cos( radians( lng ) - radians($lng) )
                        + sin ( radians($lat) )
                        * sin( radians( lat ) )
                    )
                ) AS distance
            FROM locations
            WHERE level = 2
            HAVING distance < $distance
            ORDER BY distance";
        $locations = DB::selectOne($sql);
        return $locations;
    }
}
