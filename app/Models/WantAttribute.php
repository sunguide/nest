<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WantAttribute extends Model
{
    protected $table = "wants_attributes";
    protected $fillable = ['want_id', 'name', 'value', 'sort'];

    public function want()
    {
        return $this->belongsTo(Want::class);
    }
}
