@extends ('layouts.master')

@section('title', 'Lista artykułów')

@section ('content')

    <a class="btn btn-success" href="{{ route('dashboard.blog.articles.create') }}">Dodaj nowy artykuł</a>

    <h1>Lista artykułów</h1>

    @if ($articles->isNotEmpty())
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Categories</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($articles as $article)
                <tr>
                    <th scope="row">{{ $article->id }}</th>
                    <td>{{ $article->title }}</td>
                    <td>{{ implode(', ', $article->categories->pluck('name')->toArray()) }}</td>
                    <td>
                        <a href="{{ route('dashboard.blog.articles.edit', ['article' => $article->id]) }}">
                            Edytuj
                        </a>
                        <a class="deleting-button" href="{{ route('dashboard.blog.articles.get-destroy', ['article' => $article->id]) }}">
                            Usuń
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        Brak artykułów
    @endif

@endsection
