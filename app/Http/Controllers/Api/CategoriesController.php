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

    public function store(CategoryRequest $categoryRequest, Category $category)
    {
        $category->fill($categoryRequest->all());
        $category->save();
        return $this->response->item($category, new CategoryTransformer());
    }
}
