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
}
