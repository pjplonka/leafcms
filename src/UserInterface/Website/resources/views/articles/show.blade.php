@php /** @var \LeafCms\Blog\Models\Article $article */ @endphp

@extends ('website::layouts.master')

@section('title', 'Artykuł')

@section ('content')

    <h1>Artykuł{{ $article->title }}</h1>

    <h2>Obraz:</h2>

    <img src="{{ $article->image ? $article->image->fullPath(true) : '' }}" alt="">

    <h2>Treść:</h2>

    <p>
        {!! $article->contentAsHtml() !!}
    </p>

    <h2>Tagi:</h2>

    <ul>
        @foreach ($article->tags as $tag)
            <li>
                <a>{{ $tag->name }}</a>
            </li>
        @endforeach
    </ul>

    <h2>Kategorie:</h2>

    <ul>
        @foreach ($article->categories as $category)
            <li>
                <a>{{ $category->name }}</a>
            </li>
        @endforeach
    </ul>

@endsection
