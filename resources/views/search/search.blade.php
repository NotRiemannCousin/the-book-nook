@extends('layouts.main', ['main_width' => '-webkit-fill-available'])
@php
    
    use App\Models\{Book, Genre, Author, Publisher};
@endphp
@section('title', "Search: $search_input")
@section('content')
    @php
        $books = [];
        $genres = [];
        $authors = [];
        $publishers = [];
        
        if ($checked_book) {
            $books = Book::FilteredByTitle($search_input)->paginate(30);
        }
        $models = [
            'genre' => Genre::class,
            'author' => Author::class,
            'publisher' => Publisher::class,
        ];
        
        $results = [];
        
        foreach ($models as $key => $model) {
            if (${"checked_$key"}) {
                $results[$key] = $model::FilteredByName($search_input)->paginate(30);
            }
        }
    @endphp

    @if ($checked_book)
        <div class="grid-expand" data-grid-expanded>
            <div class="align-items-center d-flex justify-content-between">
                <h2 class="d-inline">Books</h2>
                <span class="grid-expand-btn float-end"></span>
            </div>
            <section class="p-2 p-md-5 w-fill">
                @include('layouts.book.book-collection-expanded', [
                    'collection' => $books,
                ])
            </section>
        </div>




        <div class="d-flex justify-content-center">
            {!! $books->links() !!}
        </div>
    @endif




    <hr>




    @foreach ($results as $name => $collection)
        @unless ($collection)
            @continue
        @endunless

        <div class="grid-expand" data-grid-expanded>
            <div class="align-items-center d-flex justify-content-between">
                <h2>{{ str_plural(ucwords($name)) }}</h2>
                <span class="grid-expand-btn float-end"></span>
            </div>
            <section class="p-2 p-md-5 pt-md-2 w-fill">
                @forelse ($collection as $element)
                    @if ($loop->first)
                        <ul class="sla">
                    @endif
                    <li class="list-group">
                        <a class="text-decoration-none fw-normal"
                            href="/details/{{ $name }}/{{ $element->id }}">{{ $element->name }}</a>
                    </li>
                    @if ($loop->last)
                        </ul>
                        <div class="d-flex justify-content-center">
                            {!! $collection->links() !!}
                        </div>
                    @endif
                @empty
                    @include('layouts.util.nothing')
                @endforelse
            </section>
        </div>
        @if (!$loop->last)
            <hr>
        @endif
    @endforeach

@endsection
