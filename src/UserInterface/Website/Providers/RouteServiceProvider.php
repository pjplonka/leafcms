<?php declare(strict_types=1);

namespace LeafCms\UserInterface\Website\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

/**
 * Class RouteServiceProvider
 * @package LeafCms\UserInterface\Website\Providers
 */
class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'LeafCms\UserInterface\Website\Controllers';

    public function boot(): void
    {
        parent::boot();
    }

    public function map(): void
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../routes/web.php');
    }
}
