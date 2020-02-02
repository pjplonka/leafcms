@php /** @var \LeafCms\Blog\Models\Category $category */ @endphp

@extends ('website::layouts.master')

@section('title', 'Kategoria')

@section ('content')
    <div class="category-head">

        @for($i=0; $i<4; $i++)
            @if ($i===0)
                <div class="category-top">
                    <img class="category-top-bg" src="/category-title-background.jpg" />
                    <div class="information">
                        <h1 class="header">
                            KATEGORIA <br><br>
                            {{ $category->name }}
                        </h1>
                    </div>
                </div>
            @else
                <div class="category-top">
                    <img class="category-top-bg"
                         src="{{ $category->articles->get($i-1)->image ? $category->articles->get($i-1)->image->fullPath(true) : '' }}"
                    />
                    <div class="information">
                        <h2 class="header art-title">
                            <a class="link-covered" href="{{ route('website.articles.show', ['slug' => $category->articles->get($i-1)->slug]) }}">
                                {{ $category->articles->get($i-1)->title }}
                            </a>
                        </h2>
                    </div>
                </div>
            @endif
        @endfor

    </div>

    <div class="category-articles">

        @foreach ($category->articles as $article)

            <div class="article">

                <div class="image">
                    <a href="{{ route('website.articles.show', ['slug' => $article->slug]) }}">
                        <img width="275" height="230" src="{{ $article->image ? $article->image->fullPath(true) : '' }}"
                             alt="">
                    </a>
                </div>

                <div class="information">

                    <a href="{{ route('website.articles.show', ['slug' => $article->slug]) }}"
                       class="category-link link-covered">
                        {{ $article->categories->first()->name }}
                    </a>

                    <a href="" class="article-link link-covered">
                        {{ $article->title }}
                    </a>

                    <span class="published-date">
                        Październik 15, 2019
                    </span>

                </div>

            </div>

        @endforeach

    </div>

@endsection
