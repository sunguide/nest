<?php

namespace App\Transformers;

use App\Models\Category;
use App\Models\Feedback;
use League\Fractal\TransformerAbstract;

class FeedbackTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['user', 'category'];

    public function transform(Feedback $feedback)
    {
        return [
            'id' => $feedback->id,
            'user_id' => $feedback->user_id,
            'category_id' => $feedback->category_id,
            'platform' => $feedback->platform,
            'version' => $feedback->version,
            'content' => $feedback->content,
            'phone' => $feedback->phone,
            'email' => $feedback->email,
            'contact' => $feedback->contact,
            'extra' => $feedback->extra,
        ];
    }

    public function includeUser(Feedback $feedback)
    {
        if($feedback->user){
            return $this->primitive($feedback->user, new UserTransformer());
        }
    }

    public function includeCategory(Feedback $feedback)
    {
        if($feedback->category) {
            return $this->primitive($feedback->category, new CategoryTransformer());
        }
    }
}
