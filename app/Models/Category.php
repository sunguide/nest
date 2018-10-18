<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'pid',
        'name',
        'description',
        'alias'
    ];

    public function getIdByAlias($alias, $pid = 0){
        $item = self::query()->where("pid", $pid)
            ->where("alias", $alias)->first();
        return $item ? $item->id : 0;
    }
}
