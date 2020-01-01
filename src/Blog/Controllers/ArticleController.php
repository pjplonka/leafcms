<?php declare(strict_types=1);

namespace LeafCms\Blog\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use LeafCms\Blog\Models\Article;
use LeafCms\Blog\Models\Category;
use LeafCms\Blog\Models\Tag;
use LeafCms\FileCenter\Models\Image;

class ArticleController
{
    public function index()
    {
        $articles = Article::all();

        return view('blog.articles.index', [
            'articles' => $articles,
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        $images = Image::notTaken();

        return view('blog.articles.create', [
            'categories' => $categories,
            'tags'       => $tags,
            'images'     => $images,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255|unique:blog_articles',
        ]);

        /** @var Article $article */
        $article = Article::query()->create([
            'title'    => $request->input('title'),
            'slug'     => Str::slug($request->input('title')),
            'content'  => json_encode($request->input('content')),
            'image_id' => $request->input('image_id'),
        ]);

        $article->categories()->sync($request->input('categories'));

        $article->tags()->sync($request->input('tags'));

        return redirect(route('dashboard.blog.articles.index'))->with('flash-success', 'Artykuł został dodany.');
    }

    public function edit(Article $article)
    {
        $categories = Category::all();
        $tags = Tag::all();
        $images = Image::notTaken();

        if ($article->image) {
            $images->prepend($article->image);
        }

        return view('blog.articles.edit', [
            'article'    => $article,
            'categories' => $categories,
            'tags'       => $tags,
            'images'     => $images,
        ]);
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|max:255|unique:blog_articles,title,' . $article->id,
            'slug'  => 'required|max:255|unique:blog_articles,slug,' . $article->id,
        ]);

        $article->update([
            'title'   => $request->input('title'),
            'slug'    => $request->input('slug'),
            'content' => json_encode($request->input('content')),
        ]);

        $article->categories()->sync($request->input('categories'));

        $article->tags()->sync($request->input('tags'));

        return redirect(route('dashboard.blog.articles.index'))->with('flash-success', 'Arttykuł został zaktualizowany.');
    }

    public function destroy(Article $article)
    {
        $article->forceDelete();

        return redirect(route('dashboard.blog.articles.store'))->with('flash-success', 'Arttykuł został usunięty.');
    }
}
