<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = [
        'pid',
        'node',
        'name',
        'level',
        'lat',
        'lng'
    ];


    public static function getFullName($id){
        $region = Region::find($id);
        if($region){
            return $region['name'];
        }
        return '未知';
    }

    public static function getNameById($id){
        $region = Region::find($id);
        if($region){
            return $region['name'];
        }
        return '';
    }

    public static function getSubs($pid){
        $subs = Region::query()->select(["id", "pid", "name", "node", "level"])->where('pid', $pid)->get();
        if($subs){
            foreach ($subs as $k => $sub){
                $subs[$k]['subs'] = self::getSubs($sub['id']);
            }
        }
        return $subs;
    }

    public static function getSubIds($pid){
        $subIds = [];
        $subs = Region::query()->where('pid', $pid)->get();

        if($subs){
            foreach ($subs as $k => $sub){
                $subIds[] = $sub['id'];
                $_subIds = self::getSubIds($sub['id']);
                if(!empty($_subIds)){
                    $subIds = array_merge($subIds, $_subIds);
                }
            }
        }
        return $subIds;
    }
}
