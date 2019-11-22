@extends ('layouts.master')

@section('title', 'Edycja kategorii')

@section ('content')

    <a class="btn btn-secondary" href="{{ route('dashboard.blog.categories.index') }}">Powrót</a>

    <h1>Edycja kategorii</h1>

    @if ($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    @endif

    <form method="post" action="{{ route('dashboard.blog.categories.update', ['category' => $category->id]) }}">

        @csrf
        @method('put')

        <div class="form-group">
            <label for="name">Nazwa kategorii</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name) }}">
        </div>

        <div class="form-group">
            <label for="slug">Slug kategorii</label>
            <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $category->slug)  }}">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>

    </form>

@endsection
