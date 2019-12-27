@extends ('layouts.master')

@section('title', 'Dodaj tag')

@section ('content')

    <a class="btn btn-secondary" href="{{ route('dashboard.blog.tags.index') }}">Powrót</a>

    <h1>Dodaj tag</h1>

    @if ($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    @endif

    <form method="post" action="{{ route('dashboard.blog.tags.store') }}">

        @csrf

        <div class="form-group">
            <label for="name">Nazwa tagu</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>

    </form>

@endsection
