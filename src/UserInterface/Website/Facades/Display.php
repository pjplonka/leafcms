<?php declare(strict_types=1);

namespace LeafCms\UserInterface\Website\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static void categories()
 */
class Display extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'display';
    }
}
