@extends ('layouts.master')

@section('title', 'Lista kategorii')

@section ('content')

    <a class="btn btn-success" href="{{ route('dashboard.blog.categories.create') }}">Dodaj nową kategorię</a>

    <h1>Lista kategorii</h1>

    @if ($categories->isNotEmpty())
        <ul class="list-group">
            @foreach ($categories as $category)
                <li class="list-group-item d-flex justify-content-between">
                    <span>{{ $category->name }}</span>
                    <div>
                        <a href="{{ route('dashboard.blog.categories.edit', ['category' => $category->id]) }}">
                            Edytuj
                        </a>
                        <a class="deleting-button" href="{{ route('dashboard.blog.categories.get-destroy', ['category' => $category->id]) }}">
                            Usuń
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        Brak kategorii
    @endif

@endsection
