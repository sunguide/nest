<?php

namespace App\Models;

use App\Models\Store\Order;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Logistics extends Model
{
    protected $fillable = [
        'logistics_no',
        'order_id',
        'provide',
        'provide_no',
        'provide_fee',
        'consignee_name',
        'consignee_phone',
        'consignee_address',
        'consignee_zip',
        'consigner_name',
        'consigner_phone',
        'consigner_address',
        'consigner_zip',
        'fee',
        'extra',
        'status'
    ];


    protected static function boot()
    {
        parent::boot();
        // 监听模型创建事件，在写入数据库之前触发
        static::creating(function ($model) {
            // 如果模型的 no 字段为空
            if (!$model->logistics_no) {
                // 调用 findAvailableNo 生成订单流水号
                $model->logistics_no = static::getAvailablegetLogisticsNo();
                // 如果生成失败，则终止创建订单
                if (!$model->logistics_no) {
                    return false;
                }
            }
        });
    }

    public function fill(array $attributes)
    {
        $this->setAttribute('extra', '{}');
        if($attributes['address_id']){
            $address = UserAddress::find($attributes['address_id']);
            if($address){
                $this->setAttribute('consignee_name', $address->contact_name);
                $this->setAttribute('consignee_phone', $address->contact_phone);
                $this->setAttribute('consignee_address', $address->getFullAddressAttribute());
                $this->setAttribute('consignee_zip', $address->zip);
            }
        }

        if($attributes['order_id']){
            $address = Order::getAvailableRefundNo($attributes['address_id']);
            if($address){
                $this->setAttribute('consignee_name', $address->contact_name);
                $this->setAttribute('consignee_phone', $address->contact_phone);
                $this->setAttribute('consignee_address', $address->getFullAddressAttribute());
                $this->setAttribute('consignee_zip', $address->zip);
            }
        }
        return parent::fill($attributes);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public static function getAvailablegetLogisticsNo()
    {
        do {
            // Uuid类可以用来生成大概率不重复的字符串
            $no = Uuid::uuid4()->getHex();
            // 为了避免重复我们在生成之后在数据库中查询看看是否已经存在相同的退款订单号
        } while (self::query()->where('logisticts_no', $no)->exists());

        return $no;
    }
}
