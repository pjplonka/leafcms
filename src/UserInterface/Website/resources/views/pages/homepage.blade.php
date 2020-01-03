@inject('display', '\LeafCms\UserInterface\Website\Display\Display')

@extends ('website::layouts.master')

@section('title', 'Strona główna')

@section ('content')

    Lista kategorii: <br><br>

    @foreach ($display->categories()->list() as $category)
        {{ $category->name }}
    @endforeach

@endsection
