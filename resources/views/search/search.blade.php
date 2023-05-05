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
        if ($checked_author) {
            $genres = Genre::FilteredByName($search_input)->paginate(30);
        }
        if ($checked_genre) {
            $authors = Author::FilteredByName($search_input)->paginate(30);
        }
        if ($checked_publisher) {
            $publishers = Publisher::FilteredByName($search_input)->paginate(30);
        }
        
        $arrays = ['genre' => $genres, 'author' => $authors, 'publisher' => $publishers];
    @endphp

    @if ($checked_book)
        <h2>Books</h2>
        <section class="p-2 p-md-5 w-fill">
            @include('layouts.book.book-collection-expanded', [
                'collection' => $books,
            ])
        </section>
    @endif

    @foreach ($arrays as $name => $collection)
        @unless (!$collection)
            @continue
        @endunless

        <h2>{{ str_plural(ucwords($name)) }}</h2>
        <section class="p-2 p-md-5 pt-md-2 w-fill">
            @forelse ($collection as $element)
                <a class="text-decoration-none fw-normal"
                    href="/details/{{ $name }}/{{ $element->id }}">{{ $element->name }}</a><br>
            @empty
                @include('layouts.util.nothing')
            @endforelse
        </section>
    @endforeach
    </ul>
@endsection
