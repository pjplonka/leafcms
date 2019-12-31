@extends ('layouts.master')

@section('title', 'Dodaj obraz')

@section ('content')

    <a class="btn btn-secondary" href="{{ route('dashboard.file-center.images.index') }}">Powrót</a>

    <h1>Dodaj obraz</h1>

    @if ($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    @endif

    <form method="post" action="{{ route('dashboard.file-center.images.store') }}"  enctype="multipart/form-data">

        @csrf

        <div class="form-group">
            <label for="file">Plik</label>
            <input type="file" class="form-control" id="file" name="file">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>

    </form>

@endsection
