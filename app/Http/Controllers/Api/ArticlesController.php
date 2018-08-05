<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\ArticleRequest;
use App\Http\Requests\Api\CategoryRequest;
use App\Http\Requests\Api\FeedbackRequest;
use App\Models\Article;
use App\Models\Category;
use App\Transformers\ArticleTransformer;

class ArticlesController extends Controller
{
    public function index(Category $category, Article $article)
    {
        $articles = $article->where('category_id', $category->id)->paginate(10);

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
