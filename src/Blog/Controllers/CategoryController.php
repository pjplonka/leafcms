<?php declare(strict_types=1);

namespace LeafCms\Blog\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use LeafCms\Blog\Models\Category;

class CategoryController
{
    public function index()
    {
        $categories = Category::all();

        return view('blog.categories.index', [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        $categories = Category::all();

        return view('blog.categories.create', [
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:120|unique:blog_categories',
        ]);

        Category::query()->create([
            'name' => $request->get('name'),
            'slug' => Str::slug($request->get('name')),
        ]);

        return redirect(route('dashboard.blog.categories.index'))->with('flash-success', 'Kategoria została dodana.');
    }

    public function edit(Category $category)
    {
        $categories = Category::all();

        return view('blog.categories.edit', [
            'category'  => $category,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|max:120|unique:blog_categories,name,' . $category->id,
            'slug' => 'required|max:120|unique:blog_categories,slug,' . $category->id,
        ]);

        $category->update([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
        ]);

        return redirect(route('dashboard.blog.categories.index'))->with('flash-success', 'Kategoria została zaktualizowana.');
    }

    public function destroy(Category $category)
    {
        $category->forceDelete();

        return redirect(route('dashboard.blog.categories.store'))->with('flash-success', 'Kategoria została usunięta.');
    }
}
