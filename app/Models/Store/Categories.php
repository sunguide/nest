<?php

namespace App\Models\Store;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'store_categories';
    protected $fillable = ['id', 'pid', 'name', 'shop_id', 'status'];
}
