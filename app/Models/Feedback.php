<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//意见反馈
class Feedback extends Model
{

    protected $table = "feedbacks";
    protected $fillable = [
        'user_id',
        'category_id',
        'platform',
        'version',
        'phone',
        'email',
        'contact',
        'content',
        'extra'
    ];
    public function fill(array $attributes)
    {
        $this->setAttribute('extra', '{}');
        return parent::fill($attributes);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
