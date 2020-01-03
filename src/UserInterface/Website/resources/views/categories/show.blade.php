@php /** @var \LeafCms\Blog\Models\Category $category */ @endphp

@extends ('website::layouts.master')

@section('title', 'Kategoria')

@section ('content')

    <h1>Kategoria {{ $category->name }}</h1>

    <h2>Artykuły w kategorii:</h2>

    <ul>
        @foreach ($category->articles as $article)
            <li>
                <a href="{{ route('website.articles.show', ['slug' => $article->slug]) }}">
                    {{ $article->title }}
                </a>
            </li>
        @endforeach
    </ul>

@endsection
