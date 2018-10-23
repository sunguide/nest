<?php

namespace App\Models;

use App\Models\Store\Product;
use Illuminate\Database\Eloquent\Model;

class UserFavorite extends Model
{
    public $guarded = ['id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'target_type', 'target_id', 'user', 'product',  'shop',
    ];

    /**
     * get related user model.
     *
     * @return /App/User||null
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'target_id', 'id');
    }


    /**
     * Save a new record.
     *
     * @param  $userId  integer
     * @param  $targetType  string
     * @param  $targetId  integer
     * @return /App/UserFavorite
     */
    public function saveOne($userId, $targetType, $targetId)
    {
        return $this->create([
            'user_id' => $userId,
            'target_type' => $targetType,
            'target_id' => $targetId
        ]);
    }
}
