<?php

namespace App\Transformers\Store;

use App\Models\Store\Shop;
use App\Transformers\UserTransformer;
use League\Fractal\TransformerAbstract;

class ShopTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['user','products'];

    public function transform(Shop $shop)
    {
        return [
            'id' => $shop->id,
            'user_id' => (int) $shop->user_id,
            'name' => $shop->name,
            'logo' => $shop->logo,
            'images' => $shop->images,
            'introduce' => $shop->introduce,
            'address' => $shop->address,
            'contact' => $shop->contact,
            'telphone' => $shop->telphone,
            'tags' => $shop->tags,
            'positions' => $shop->positions,
            'field_certified' => $shop->field_certified,
            'realname_certified' => $shop->realname_certified,
            'company_certified' => $shop->company_certified,
            'on_sale' => $shop->on_sale? true: false,
            'category_id' => (int) $shop->category_id,
            'view_count' => (int) $shop->view_count,
            'favorite_count' => (int) $shop->favorite_count,
            'product_count' => (int) $shop->product_count,
            'rating' => $shop->rating,
            'created_at' => $shop->created_at->toDateTimeString(),
            'updated_at' => $shop->updated_at->toDateTimeString(),
        ];
    }

    public function includeUser(Shop $shop)
    {
        return $this->item($shop->user, new UserTransformer());
    }

    public function includeProducts(Shop $shop){
        return $shop->products;
    }
}
