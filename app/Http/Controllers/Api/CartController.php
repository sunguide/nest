<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CartRequest;
use App\Http\Requests\Api\CategoryRequest;
use App\Models\Category;
use App\Models\Store\CartItem;
use App\Models\Store\Product;
use Illuminate\Http\Request;
use App\Transformers\CategoryTransformer;

class CartController extends Controller
{
    public function index()
    {
        return $this->response->collection(Category::all(), new CategoryTransformer());
    }

    public function store(CartRequest $request, CartItem $cartItem)
    {
        $cartItem->fill($request->all());
        $cartItem->save();
        return $this->response->item($cartItem, new CategoryTransformer());
    }

    public function destroy(Product $product){
        $categories = Category::query()->select(['id', 'pid','name','alias','description'])->where("pid", $pid)->get();
        if($categories){
            foreach ($categories as $k => $category){
                $categories[$k]['subs'] = $this->getSubs($category->id);
            }
        }
        return $categories;
    }
}
