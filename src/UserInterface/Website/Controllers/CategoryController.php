<?php declare(strict_types=1);

namespace LeafCms\UserInterface\Website\Controllers;

use LeafCms\Blog\Models\Category;

class CategoryController
{
    public function show($slug)
    {
        $category = Category::query()->where('slug', '=', $slug)->first();

        return view('website::categories.show', [
            'category' => $category
        ]);
    }
}
