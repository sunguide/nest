<?php

namespace App\Transformers;

use App\Models\Store\ProductReview;
use League\Fractal\TransformerAbstract;

class ProductReviewTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['user'];

    public function transform(ProductReview $review)
    {
        return [
            'id' => $review->id,
            'user_id' => (int) $review->user_id,
            'product_id' => (int) $review->product_id,
            'sku_id' => (int) $review->sku_id,
            'content' => $review->content,
            'images' =>  strval($review->images),
            'grade' => floatval($review->grade),
            'is_anonymous' => boolval($review->is_anonymous),
            'created_at' => $review->created_at->toDateTimeString(),
            'updated_at' => $review->updated_at->toDateTimeString(),
        ];
    }

    public function includeUser(ProductReview $review)
    {
        return $this->primitive($review->user, new UserTransformer());
    }
}
