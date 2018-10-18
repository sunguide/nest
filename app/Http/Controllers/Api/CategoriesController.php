<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Transformers\CategoryTransformer;

class CategoriesController extends Controller
{
    public function index()
    {
        return $this->response->collection(Category::all(), new CategoryTransformer());
    }

    public function product()
    {
        $category = Category::query()->where('pid',0)->where("alias",'product')->first();
        $categories = [];
        if($category){
            $categories = $this->getSubs($category->id);
        }
        return $this->json($categories);
    }

    public function store(CategoryRequest $categoryRequest, Category $category)
    {
        $category->fill($categoryRequest->all());
        $category->save();
        return $this->response->item($category, new CategoryTransformer());
    }

    private function getSubs($pid){
        $categories = Category::query()->select(['id', 'pid','name','alias','description'])->where("pid", $pid)->get();
        if($categories){
            foreach ($categories as $k => $category){
                $categories[$k]['subs'] = $this->getSubs($category->id);
            }
        }
        return $categories;
    }
}
