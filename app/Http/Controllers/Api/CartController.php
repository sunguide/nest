<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\InternalException;
use App\Exceptions\InvalidRequestException;
use App\Http\Requests\Api\CartRequest;
use App\Http\Requests\Api\CategoryRequest;
use App\Models\Category;
use App\Models\Store\CartItem;
use App\Models\Store\Product;
use App\Transformers\CartItemTransformer;
use Illuminate\Http\Request;
use App\Transformers\CategoryTransformer;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::query()->where("amount", '>', 0)->get();
        return $this->response->collection($cartItems, new CartItemTransformer());
    }

    public function store(CartRequest $request, CartItem $cartItem)
    {
        if(CartItem::query()->where("product_sku_id", $request->input("product_sku_id"))->where("user_id", $this->user()->id)->first()){
            throw new InvalidRequestException("已经加入购物车");
        }
        $cartItem->fill($request->all());
        $cartItem->user_id = $this->user()->id;
        $cartItem->save();
        return $this->response->item($cartItem, new CartItemTransformer());
    }

    public function update(CartRequest $request)
    {
        $cartItem = CartItem::query()->where("product_sku_id", $request->input("product_sku_id"))->where("user_id", $this->user()->id)->first();
        if(!$cartItem){
            $cartItem = new CartItem();
            $cartItem->fill($request->all());
            $cartItem->user_id = $this->user()->id;
            $cartItem->save();
        }else{
            $cartItem->update($request->all());
        }
        return $this->response->item($cartItem, new CartItemTransformer());
    }

    public function destroy(CartRequest $request){
        $result = CartItem::query()->where("product_sku_id", $request->input("product_sku_id"))->where("user_id", $this->user()->id)->delete();
        if($result){
            $this->response->noContent();
        }else{
            throw new InternalException("移除失败");
        }
    }
}
