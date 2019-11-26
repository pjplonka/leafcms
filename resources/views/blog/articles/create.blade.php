@extends ('layouts.master')

@section('title', 'Dodaj artykuł')

@section ('content')

    <a class="btn btn-secondary" href="{{ route('dashboard.blog.articles.index') }}">Powrót</a>

    <h1>Dodaj artykuł</h1>

    @if ($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    @endif

    <form method="post" action="{{ route('dashboard.blog.articles.store') }}">

        @csrf

        <button type="submit" class="btn btn-primary">Submit</button>

        <div class="form-group">
            <label for="title">Tytuł</label>
            <input type="text" class="form-control" id="title" name="title">
        </div>

        <h3>Content</h3>

        <style>
            .add-button {
                border: 1px solid grey;
                cursor: pointer;
                padding: 10px;
            }

            .add-button:hover {
                background: grey;
            }
        </style>

        <div style="margin: 20px 0;">
            <span id="add-header" class="add-button">Dodaj nagłówek</span>
            <span id="add-paragraph" class="add-button">Dodaj tekst</span>
        </div>

        <div id="content-wrapper"></div>

    </form>

    <script src="/dashboard/js/content-creator.js"></script>
    <script>
      let contentCounter = 0;
      let buttonsWrapper = document.querySelector('#content-wrapper');

      // Header
      let headerButton = document.querySelector('#add-header');
      headerButton.addEventListener('click', function () {
        buttonsWrapper.append(createHeader(contentCounter));
        contentCounter++;
      });

      // Paragraph
      let paragraphButton = document.querySelector('#add-paragraph');
      paragraphButton.addEventListener('click', function () {
        buttonsWrapper.append(createParagraph(contentCounter));
        $R('.paragraph');
        contentCounter++;
      });
    </script>

@endsection
