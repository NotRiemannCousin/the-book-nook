@extends('layouts.main')
@php
    use App\Models\{Book, Genre, Author, Publisher};

    $main_genres = $author->mainGenres();
    $main_genre = optional($main_genres[0]);

    $main_publishers = $author->mainPublishers();
    $main_publisher = optional($main_publishers[0]);

@endphp
@section('title', "$author->name - Author")

@section('content')
    <section class="border rounded-2 p-3">
        <div class="d-flex flex-column d-lg-grid border mb-4">
        <div class="book-details-content p-3 flex-grow-1">
                <h1 class="mb-2">{{ $author->name }}<span class="text-dead"> - Author</span></h1>
                <hr>
                @if ($main_genre)
                    <h6>Main Genre:
                        <a class="text-decoration-none fw-normal" href="/details/genre/{{ $main_genre->id }}">
                            {{ $main_genre->name }}
                        </a>
                    </h6>
                @endif
                @if ($main_publisher)
                    <h6>More works published by:
                        <a class="text-decoration-none fw-normal" href="/details/publisher/{{ $main_publisher->id }}">
                            {{ $main_publisher->name }}
                        </a>
                    </h6>
                @endif
                <h6>Total books count:
                    <span class="fw-normal">
                        {{ $author->books->count() }}
                    </span>
                </h6>
    </section>
    @include('layouts.book.book-collection', ['name' => 'Some Books', 'collection' => $author->books])
    @if ($main_genre)
        @include('layouts.book.book-collection', [
            'name' => 'Main Genre: ' . $main_genre->name,
            'collection' => $main_genre->books,
        ])
    @endif
@endsection
