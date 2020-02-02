@php /** @var \LeafCms\UserInterface\Website\Display\Display $display */ @endphp
@inject('display', '\LeafCms\UserInterface\Website\Display\Display')

<section class="menu-manager">

    <ul class="menu-list list-covered">

        <li class="menu-list-link">
            <a href="{{ route('website.pages.homepage') }}" class="menu-list-href link-covered">
                Strona Główna
            </a>
        </li>

        @foreach ($display->categories()->list() as $category)
            <li class="menu-list-link">
                <a href="{{ route('website.categories.show', ['slug' => $category->slug]) }}"
                   class="menu-list-href link-covered">
                    {{ $category->name }}
                </a>
            </li>
        @endforeach

        <li class="menu-list-link">
            <a href="" class="menu-list-href link-covered">
                Kontakt
            </a>
        </li>

    </ul>

</section>
