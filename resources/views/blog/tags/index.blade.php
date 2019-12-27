@extends ('layouts.master')

@section('title', 'Lista tagow')

@section ('content')

    <a class="btn btn-success" href="{{ route('dashboard.blog.tags.create') }}">Dodaj nowy tag</a>

    <h1>Lista tagow</h1>

    @if ($tags->isNotEmpty())
        <ul class="list-group">
            @foreach ($tags as $tag)
                <li class="list-group-item d-flex justify-content-between">
                    <span>{{ $tag->name }}</span>
                    <div>
                        <a href="{{ route('dashboard.blog.tags.edit', ['tag' => $tag->id]) }}">
                            Edytuj
                        </a>
                        <a class="deleting-button" href="{{ route('dashboard.blog.tags.get-destroy', ['tag' => $tag->id]) }}">
                            Usuń
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        Brak tagow
    @endif

@endsection
