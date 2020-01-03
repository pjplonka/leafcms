<?php declare(strict_types=1);

namespace LeafCms\UserInterface\Website\Controllers;

class PageController
{
    public function homepage()
    {
        return view('website::pages.homepage');
    }
}
