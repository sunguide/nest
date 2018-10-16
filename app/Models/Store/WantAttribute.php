<?php

namespace App\Models\Store;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;

class WantAttribute extends Model
{
    protected $table = "store_wants_attributes";
    protected $fillable = ['want_id', 'name', 'value', 'sort'];

    public function want()
    {
        return $this->belongsTo(Want::class);
    }
}
