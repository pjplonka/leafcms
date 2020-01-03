@php /** @var \LeafCms\Blog\Models\Article $article */ @endphp

@extends ('website::layouts.master')

@section('title', 'Artykuł')

@section ('content')

    <h1>Artykuł{{ $article->title }}</h1>

    <h2>Treść:</h2>

    <p>
        <b>TODO:</b> Do implementacji.
    </p>

    <h2>Tagi:</h2>

    <ul>
        @foreach ($article->tags as $tag)
            <li>
                <a>{{ $tag->name }}</a>
            </li>
        @endforeach
    </ul>

@endsection
