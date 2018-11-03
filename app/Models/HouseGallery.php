<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class HouseGallery extends Model
{

    protected $fillable = [
        'house_id',
        'url',
        'extra',
        'is_featured',
    ];

    protected $casts = [
        'is_featured' => 'boolean'
    ];

    public function house()
    {
        return $this->belongsTo(House::class);
    }
}