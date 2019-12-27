@extends ('layouts.master')

@section('title', 'Edycja tagu')

@section ('content')

    <a class="btn btn-secondary" href="{{ route('dashboard.blog.tags.index') }}">Powrót</a>

    <h1>Edycja tagu</h1>

    @if ($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    @endif

    <form method="post" action="{{ route('dashboard.blog.tags.update', ['tag' => $tag->id]) }}">

        @csrf
        @method('put')

        <div class="form-group">
            <label for="name">Nazwa tagu</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $tag->name) }}">
        </div>

        <div class="form-group">
            <label for="slug">Slug tagu</label>
            <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $tag->slug)  }}">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>

    </form>

@endsection
