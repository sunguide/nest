<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\ArticleRequest;
use App\Http\Requests\Request;
use App\Models\Article;
use App\Models\Category;
use App\Transformers\ArticleTransformer;

class ArticlesController extends Controller
{
    public function index(Request $request, Category $category, Article $article)
    {
        $categoryId = $category?$category->id:'';
        if($request->category){
            $categoryId = $category->getIdByAlias($request->category);
        }
        $articles = $article->where('category_id', $categoryId)->paginate(10);

        return $this->response->paginator($articles, new ArticleTransformer());
    }

    public function store(ArticleRequest $articleRequest, Article $article)
    {
        $article->fill($articleRequest->all());
        $article->user_id = \Auth::id()?:0;
        $article->save();
        return $this->response->item($article, new ArticleTransformer());
    }
}
