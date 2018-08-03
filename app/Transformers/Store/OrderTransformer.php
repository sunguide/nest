<?php

namespace App\Transformers\Store;

use App\Models\Store\Order;
use App\Transformers\UserTransformer;
use League\Fractal\TransformerAbstract;

class OrderTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['user'];

    public function transform(Order $order)
    {
        return [
            'id' => $order->id,
            'no' => $order->no,
            'user_id' => (int) $order->user_id,
            'address' => $order->address,
            'total_amount' => $order->total_amount,
            'remark' => $order->remark,
            'paid_at' => $order->paid_at,
            'coupon_id' => $order->coupon_id,
            'payment_method' => $order->payment_method,
            'payment_no' => $order->payment_no,
            'refund_status' => $order->refund_status,
            'refund_no' => $order->refund_no,
            'closed' => $order->closed,
            'reviewed' => $order->reviewed,
            'ship_status' => $order->ship_status,
            'ship_data' => $order->ship_data,
            'extra' => $order->extra,
            'items' => $order->items,
            'created_at' => $order->created_at->toDateTimeString(),
            'updated_at' => $order->updated_at->toDateTimeString(),
        ];
    }

    public function includeUser(Order $order)
    {
        return $this->item($order->user, new UserTransformer());
    }
}
