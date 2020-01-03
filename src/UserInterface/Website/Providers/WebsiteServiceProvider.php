<?php declare(strict_types=1);

namespace LeafCms\UserInterface\Website\Providers;

use Illuminate\Support\ServiceProvider;
use LeafCms\UserInterface\Website\Display\Display;

class WebsiteServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind('display', Display::class);

        $this->app->register(RouteServiceProvider::class);
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'website');
    }
}
