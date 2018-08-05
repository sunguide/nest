<?php

namespace App\Transformers;

use App\Models\Article;
use App\Models\Logistics;
use App\Models\Store\Order;
use App\Transformers\Store\OrderTransformer;
use League\Fractal\TransformerAbstract;

class LogisticsTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['order'];

    public function transform(Logistics $article)
    {
        return [
            'id' => $article->id,
            'logistics_no' => $article->logistics_no,
            'order_id' => $article->order_id,
            'provide' => $article->provide,
            'provide_no' => $article->provide_no,
            'provide_fee' => $article->provide_fee,
            'consignee_name' => $article->consignee_name,
            'consignee_phone' => $article->consignee_phone,
            'consignee_address' => $article->consignee_address,
            'consignee_zip' => $article->consignee_zip,
            'consigner_name' => $article->consigner_name,
            'consigner_phone' => $article->consigner_phone,
            'consigner_address' => $article->consigner_address,
            'consigner_zip' => $article->consigner_zip,
            'fee' => $article->fee,
            'extra' => $article->extra,
            'status' => $article->status,
            'created_at' => $article->created_at->toDateString(),
            'updated_at' => $article->updated_at->toDateString(),
        ];
    }

    public function includeOrder(Logistics $logistics)
    {
        if($logistics->order){
            return $this->item($logistics->order, new OrderTransformer());
        }
    }
}
