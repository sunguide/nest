<?php

namespace App\Http\Requests\Api;

use App\Models\StoreProductSku;
use Illuminate\Validation\Rule;

class OrderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    // 判断用户提交的地址 ID 是否存在于数据库并且属于当前用户
                    // 后面这个条件非常重要，否则恶意用户可以用不同的地址 ID 不断提交订单来遍历出平台所有用户的收货地址
                    'address_id'     => ['required', Rule::exists('user_addresses', 'id')->where('user_id', $this->user()->id)],
                    'items'          => ['required', 'array'],
                    'items.*.sku_id' => [ // 检查 items 数组下每一个子数组的 sku_id 参数
                        'required',
                        function ($attribute, $value, $fail) {
                            if (!$sku = StoreProductSku::find($value)) {
                                $fail('该商品不存在');
                                return;
                            }
                            if (!$sku->product->on_sale) {
                                $fail('该商品未上架');
                                return;
                            }
                            if ($sku->stock === 0) {
                                $fail('该商品已售完');
                                return;
                            }
                            // 获取当前索引
                            preg_match('/items\.(\d+)\.sku_id/', $attribute, $m);
                            $index  = $m[1];
                            // 根据索引找到用户所提交的购买数量
                            $amount = $this->input('items')[$index]['amount'];
                            if ($amount > 0 && $amount > $sku->stock) {
                                $fail('该商品库存不足');
                                return;
                            }
                        },
                    ],
                    'items.*.amount' => ['required', 'integer', 'min:1'],
                ];
                break;
            case 'PATCH':
                return [

                ];
                break;
        }
    }

    public function attributes()
    {
        return [
            'product_id' => '请选择商品',
            'product_sku_id' => '请选择商品规格',
            'amount' => '请确认商品数量',
        ];
    }
}
