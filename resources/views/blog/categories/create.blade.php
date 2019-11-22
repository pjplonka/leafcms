@extends ('layouts.master')

@section('title', 'Lista kategorii')

@section ('content')

    <a class="btn btn-secondary" href="{{ route('dashboard.blog.categories.index') }}">Powrót</a>

    <h1>Dodaj kategorię</h1>

    @if ($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    @endif

    <form method="post" action="{{ route('dashboard.blog.categories.store') }}">

        @csrf

        <div class="form-group">
            <label for="name">Nazwa kategorii</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>

    </form>

@endsection
