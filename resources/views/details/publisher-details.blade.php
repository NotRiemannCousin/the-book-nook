@extends('layouts.main')
@php
    use App\Models\{Book, Genre, Author, Publisher};

    $main_authors = $publisher->mainAuthors()->pick(3);
    $main_author = optional($main_authors[0]);

    $main_genres = $publisher->mainGenres()->pick(3);
    $main_genre = optional($main_genres[0]);

@endphp
@section('title', "$publisher->name - Publisher")


@section('content')
    <section class="border rounded-2 p-3">
        <div class="d-flex flex-column d-lg-grid border mb-4">
            <div class="book-details-content p-3 flex-grow-1">
                <h1 class="mb-2">{{ $publisher->name }}<span class="text-dead"> - Publisher</span></h1>
                <hr>
                @if ($main_author)
                    <h6>Featured author:
                        <a class="text-decoration-none fw-normal" href="/details/author/{{ $main_author->id }}">
                            {{ $main_author->name }}
                        </a>
                    </h6>
                @endif
                @if ($main_genre)
                    <h6>Main Genre:
                        <a class="text-decoration-none fw-normal" href="/details/genre/{{ $main_genre->id }}">
                            {{ $main_genre->name }}
                        </a>
                    </h6>
                @endif
                <h6>Total books count:
                    <span class="fw-normal">
                        {{ $publisher->books->count() }}
                    </span>
                </h6>
                <h6>Related authors:
                    <span class="fw-normal">
                        {{ $main_authors->count() }}
                    </span>
                </h6>
    </section>
    @include('layouts.book.book-collection', ['name' => "$publisher->name Best Sellers", 'collection' => $publisher->books()->BestSellers()->pick()])
    @if ($main_author)
        @include('layouts.book.book-collection', [
            'name' => 'Featured author: ' . $main_author->name,
            'collection' => $main_author->books,
        ])
    @endif
@endsection
