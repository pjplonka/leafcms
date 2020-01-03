<?php declare(strict_types=1);

namespace LeafCms\UserInterface\Website\Controllers;

use LeafCms\Blog\Models\Article;

class ArticleController
{
    public function show($slug)
    {
        $article = Article::query()->where('slug', '=', $slug)->first();

        return view('website::articles.show', [
            'article' => $article
        ]);
    }
}
