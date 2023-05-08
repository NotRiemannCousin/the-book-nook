@extends('layouts.main')
@php
    use App\Models\Book;
    use App\Models\Genre;
@endphp
@section('header')
    <div id="carousel-random" class="carousel slide mb-5 text-body" data-bs-ride="carousel">
        <div class="carousel-indicators">
            @foreach ($carousel as $item)
                <button type="button" data-bs-target="#carousel-random" data-bs-slide-to="{{ $loop->index }}"
                    aria-label="Slide {{ $loop->iteration }}"
                    @if ($loop->first) class="active" aria-current="true" @endif></button>
            @endforeach
        </div>
        <div class="carousel-inner">
            @foreach ($carousel as $item)
                <div @class([
                    'carousel-item' => true,
                    'active' => $loop->first,
                ])>
                    <a href="details/book/{{ $item->id }}">
                        <img src="https://dummyimage.com/1800x500/dbdbdb/787878.png&text={{ urlencode($item->title) }}"
                            srcset="
                        https://dummyimage.com/300x600/dbdbdb/787878.png&text={{ urlencode($item->title) }} 40w,
                        https://dummyimage.com/800x800/dbdbdb/787878.png&text={{ urlencode($item->title) }} 770w,
                        https://dummyimage.com/1800x500/dbdbdb/787878.png&text={{ urlencode($item->title) }} 1600w
                        "
                            class="d-block w-100" alt="...">
                    </a>
                    <div class="text-body carousel-caption d-none d-md-block">
                        <h5>{{ $item->title }}</h5>
                        <p>Check what we have chosen for you.</p>
                    </div>
                </div>
            @endforeach
        </div>
        <div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carousel-random" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carousel-random" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
@endsection

@section('content')
    @foreach ($collections as $name => $collection)
        @include('layouts.book.book-collection', ['name' => $name, 'collection' => $collection])
    @endforeach

    <div class="py-4 px-1 p-md-4 rounded-2 border sub-collection">
        <h1>Some Genres...</h1>
        <section class="p-2 p-md-5">
            @foreach (Genre::inRandomOrder()->pick(3) as $genre)
                @include('layouts.book.book-collection', [
                    'name' => $genre->name,
                    'collection' => $genre->books,
                ])
            @endforeach
        </section>
    </div>
@endsection
