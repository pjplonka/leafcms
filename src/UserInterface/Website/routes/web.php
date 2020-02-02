<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'PageController@homepage')->name('website.pages.homepage');

Route::get('/kategoria/{slug}', 'CategoryController@show')->name('website.categories.show');

Route::get('/artykul/{slug}', 'ArticleController@show')->name('website.articles.show');
