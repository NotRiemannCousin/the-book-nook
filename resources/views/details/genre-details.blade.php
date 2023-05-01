@extends('layouts.main')
@php
    use App\Models\{Book, Genre, Author, Publisher};

    $main_authors = $genre->mainAuthors();
    $main_author = optional($main_authors[0]);

    $main_publishers = $genre->mainPublishers();
    $main_publisher = optional($main_publishers[0]);

@endphp
@section('content')
    <section class="border rounded-2 p-3">
        <div class="d-flex flex-column d-lg-grid border mb-4">
            <div class="book-details-content p-3 flex-grow-1">
                <h1 class="mb-2">{{ $genre->name }} <span class="text-dead"> - Genre</span></h1>
                <hr>
                @if ($main_author)
                    <h6>Related author:
                        <a class="text-decoration-none fw-normal" href="/details/author/{{ $main_author->id }}">
                            {{ $main_author->name }}
                        </a>
                    </h6>
                @endif
                @if ($main_publisher)
                    <h6>Related publisher:
                        <a class="text-decoration-none fw-normal" href="/details/publisher/{{ $main_publisher->id }}">
                            {{ $main_publisher->name }}
                        </a>
                    </h6>
                @endif
                <h6>Total books count;
                    <span class="fw-normal">
                        {{ $genre->books->count() }}
                    </span>
                </h6>
                <h6>Authors:
                    <span class="fw-normal">
                        {{ $main_authors->count() }}
                    </span>
                </h6>
    </section>
    @include('layouts.book.book-collection', ['name' => "$genre->name best sellers", 'collection' => $genre->books])
    @if ($main_author)
        @include('layouts.book.book-collection', [
            'name' => 'Main Author: ' . $main_author->name,
            'collection' => $main_author->books,
        ])
    @endif
@endsection
