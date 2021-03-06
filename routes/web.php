<?php declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::prefix('dashboard')->name('dashboard.')->group(function () {

    Route::prefix('blog')->name('blog.')->group(function () {

        Route::get('/blog/categories/{category}/delete', '\LeafCms\Blog\Controllers\CategoryController@destroy')
            ->name('categories.get-destroy');
        Route::resource('categories', '\LeafCms\Blog\Controllers\CategoryController');

        Route::get('/blog/articles/{article}/delete', '\LeafCms\Blog\Controllers\ArticleController@destroy')
            ->name('articles.get-destroy');
        Route::resource('articles', '\LeafCms\Blog\Controllers\ArticleController');

        Route::get('/blog/tags/{tag}/delete', '\LeafCms\Blog\Controllers\TagController@destroy')
            ->name('tags.get-destroy');
        Route::resource('tags', '\LeafCms\Blog\Controllers\TagController');

    });

    Route::prefix('file-center')->name('file-center.')->group(function () {

        Route::get('/file-center/images/{image}/delete', '\LeafCms\FileCenter\Controllers\ImageController@destroy')
            ->name('images.get-destroy');
        Route::resource('images', '\LeafCms\FileCenter\Controllers\ImageController');

    });

});
