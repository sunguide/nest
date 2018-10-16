<?php

namespace App\Models\Store;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;

class Want extends Model
{
    protected $table = "store_wants";
    protected $fillable = ['user_id', 'category_id', 'name', 'deadline', 'requirement', 'specification', 'amount',
        'introduction','is_featured','sort'];
    protected $casts = [
        'is_featured' => 'boolean', // is_featured 是一个布尔类型的字段
    ];
    // attributes
    public function attributes()
    {
        return $this->hasMany(WantAttribute::class);
    }

    public function setAttribute($key, $value)
    {
        parent::setAttribute($key, $value);
        if($this->id){
            $attribute = new WantAttribute();
            $attribute->fill([
                'want_id' => $this->id,
                'name' => $key,
                'value' => $value
            ]);
            return $attribute->save();
        }
        return true;
    }
}
