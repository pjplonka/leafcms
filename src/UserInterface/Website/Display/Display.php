<?php declare(strict_types=1);

namespace LeafCms\UserInterface\Website\Display;

class Display
{
    public function categories(): Categories
    {
        return new Categories;
    }
}
