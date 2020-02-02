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

        <div class="form-group">
            <label for="published_at">Data publikacji</label>
            <input type="date" class="form-control" id="published_at" name="published_at" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
        </div>

        <div class="form-group">
            <label for="categories">Kategorie</label>
            <select multiple class="form-control" id="categories" name="categories[]">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="tags">Tagi</label>
            <select multiple class="form-control" id="tags" name="tags[]">
                @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="image_id">Obraz</label>
            <select class="form-control" id="image_id" name="image_id">
                <option value="">Brak</option>
                @foreach ($images as $image)
                    <option value="{{ $image->id }}">{{ $image->id }} | {{ $image->fullFilename() }}</option>
                @endforeach
            </select>
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
