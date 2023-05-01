    <section>
        @isset($name)
            <h2>
                {{ $name }}
            </h2>
        @endisset
        @if (count($collection))
            <div class="d-grid t-columns-2 t-columns-sm-3 t-columns-lg-5 grid-expand">
                @each('layouts.book.book-wrapper', $collection, 'book')
            </div>
            <span class='grid-expand-btn'></span>
        @else
            @include('layouts.util.nothing')
        @endif
    </section>
