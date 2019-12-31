@extends ('layouts.master')

@section('title', 'Lista obrazow')

@section ('content')

    <a class="btn btn-success" href="{{ route('dashboard.file-center.images.create') }}">Dodaj nowy obraz</a>

    <h1>Lista obrazow</h1>

    @if ($images->isNotEmpty())
        <ul class="list-group">
            @foreach ($images as $image)
                <li class="list-group-item d-flex justify-content-between">
                    <span>{{ $image->fullFilename() }}</span>
                    <span>
                        <img width="100" src="/{{ $image->fullPath() }}">
                    </span>
                    <div>
                        <a href="{{ route('dashboard.file-center.images.edit', ['image' => $image->id]) }}">
                            Edytuj
                        </a>
                        <a class="deleting-button" href="{{ route('dashboard.file-center.images.get-destroy', ['image' => $image->id]) }}">
                            Usuń
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        Brak obrazow
    @endif

@endsection
