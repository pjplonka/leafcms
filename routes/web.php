<?php declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::prefix('blog')->name('blog.')->group(function () {
        Route::get('/blog/categories/{category}/delete', '\LeafCms\Blog\Controllers\CategoryController@destroy')->name('categories.get-destroy');
        Route::resource('categories', '\LeafCms\Blog\Controllers\CategoryController');
    });
});
