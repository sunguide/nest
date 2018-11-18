<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Want extends Model
{
    protected $table = "wants";
    protected $fillable = [
        'user_id',
        'type',
        'purpose',
        'trade',
        'title',
        'description',
        'budget_min',
        'budget_max',
        'region_ids',
        'contact_name',
        'contact_gender',
        'contact_tel',
        'address',
        'features',
        'is_approved',
        'is_featured',
        'status',
        'sort',
    ];
    protected $casts = [
        'is_featured' => 'boolean', // is_featured 是一个布尔类型的字段
        'is_approved' => 'boolean', // is_approved 是一个布尔类型的字段
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function regions()
    {
        return [];
    }
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
