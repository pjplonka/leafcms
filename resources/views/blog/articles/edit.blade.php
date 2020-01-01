@extends ('layouts.master')

@section('title', 'Edycja artykułu')

@section ('content')

    <a class="btn btn-secondary" href="{{ route('dashboard.blog.articles.index') }}">Powrót</a>

    <h1>Edycja artykułu</h1>

    @if ($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    @endif

    <form method="post" action="{{ route('dashboard.blog.articles.update', ['article' => $article->id]) }}">

        @csrf
        @method('put')

        <div class="form-group">
            <label for="title">Tytuł</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('name', $article->title) }}">
        </div>

        <div class="form-group">
            <label for="categories">Kategorie</label>
            <select multiple class="form-control" id="categories" name="categories[]">
                @foreach ($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        {{ $article->categories->firstWhere('id', '=', $category->id) ? 'selected' : '' }}
                    >{{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="tags">Tagi</label>
            <select multiple class="form-control" id="tags" name="tags[]">
                @foreach ($tags as $tag)
                    <option
                        value="{{ $tag->id }}"
                        {{ $article->tags->firstWhere('id', '=', $tag->id) ? 'selected' : '' }}
                    >{{ $tag->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="image_id">Obraz</label>
            <select class="form-control" id="image_id" name="image_id">
                <option value="" {{ $article->image_id === null ? 'selected' : '' }}>Brak</option>
                @foreach ($images as $image)
                    <option
                        value="{{ $image->id }}"
                        {{ (int) $article->image_id === (int) $image->id ? 'selected' : '' }}
                    >
                        {{ $image->id }} | {{ $image->fullFilename() }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $article->slug)  }}">
        </div>

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

        <button type="submit" class="btn btn-primary">Submit</button>

    </form>

    <script src="/dashboard/js/content-creator.js"></script>
    <script>

      let json = '{!! $article->content  !!}';
      let content = JSON.parse(json);
      let buttonsWrapper = document.querySelector('#content-wrapper');
      let contentCounter = 0;

      content.forEach(function (elem) {

        if (elem.type === 'header') {
          buttonsWrapper.append(createHeader(contentCounter, elem.level, elem.value));
        } else if (elem.type === 'paragraph') {
          buttonsWrapper.append(createParagraph(contentCounter, elem.value));
          $R('.paragraph');
        }

        contentCounter++;
      });

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
