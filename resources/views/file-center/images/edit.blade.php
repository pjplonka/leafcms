@extends ('layouts.master')

@section('title', 'Edycja obrazu')

@section ('content')

    <a class="btn btn-secondary" href="{{ route('dashboard.file-center.images.index') }}">Powrót</a>

    <h1>Edycja obrazu</h1>

    @if ($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    @endif

    <form method="post" action="{{ route('dashboard.file-center.images.update', ['image' => $image->id]) }}">

        @csrf
        @method('put')

        <img width="100" src="/{{ $image->fullPath() }}">

        <div class="form-group">
            <label for="filename">Nazwa pliku</label>
            <input type="text" class="form-control" id="filename" name="filename" value="{{ old('filename', $image->filename) }}">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>

    </form>

@endsection
