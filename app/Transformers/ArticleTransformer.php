<?php

namespace App\Transformers;

use App\Models\Article;
use League\Fractal\TransformerAbstract;

class ArticleTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['user', 'category'];

    public function transform(Article $article)
    {
        return [
            'id' => $article->id,
            'user_id' => intval($article->user_id),
            'category_id' => $article->category_id,
            'cover' => $article->cover,
            'title' => $article->title,
            'summary' => $article->summary,
            'content' => $article->content,
            'source' => $article->source,
            'source_author' => $article->source_author,
            'source_url' => $article->source_url,
            'weight' => $article->weight,
            'status' => $article->status,
            'created_at' => $article->created_at->toDateString(),
            'updated_at' => $article->updated_at->toDateString(),
        ];
    }

    public function includeUser(Article $article)
    {
        if($article->user){
            return $this->primitive($article->user, new UserTransformer());
        }
    }

    public function includeCategory(Article $article)
    {
        if($article->category) {
            return $this->primitive($article->category, new CategoryTransformer());
        }
    }
}
