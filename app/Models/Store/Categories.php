<?php

namespace App\Models\Store;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'store_categories';
    protected $fillable = [
        'id',
        'pid',
        'name',
        'shop_id',
        'status'
    ];


    public function products(){
        return Product::query()->where("shop_id", $this->shop_id)->where("shop_category_id", $this->id)->limit(10)->get();
    }
}
