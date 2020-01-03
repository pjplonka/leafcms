<?php declare(strict_types=1);

namespace LeafCms\UserInterface\Website\Display;

use LeafCms\Blog\Models\Category;

class Categories
{
    /** @return Category[] */
    public function list()
    {
        return Category::all();
    }
}
