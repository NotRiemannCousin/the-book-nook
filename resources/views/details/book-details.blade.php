@extends('layouts.main')

@section('title', "$book->title - Book")

@section('content')
    <section class="border rounded-2 p-3">
        <div class="d-flex flex-column d-lg-grid book-details border mb-4">
            <img class="m-auto book-details-image fill-available"
                src="{{ file_exists($book->image) ? $book->image : '/img/default-book.png' }}"
                style="max-height: 20em; max-width: -webkit-fill-available" alt="{{ $book->title }}">
            <div class="book-details-content p-3 flex-grow-1">
                <h1 class="mb-2">{{ $book->title }}</h1>
                @if ($book->subtitle)
                    <h4 class="fw-normal">{{ $book->subtitle }}</h4>
                @endif
                <hr>
                <h6>Author:
                    <a class="text-decoration-none fw-normal" href="/details/author/{{ $book->author->id }}">
                        {{ $book->author->name }}
                    </a>
                </h6>
                <h6>Publisher:
                    <a class="text-decoration-none fw-normal" href="/details/publisher/{{ $book->publisher->id }}">
                        {{ $book->publisher->name }}
                    </a>
                </h6>
                <h6>Genre:
                    <a class="text-decoration-none fw-normal" href="/details/genre/{{ $book->genre->id }}">
                        {{ $book->genre->name }}
                    </a>
                </h6>
                <h6>ISBN: <span class="fw-normal">{{ $book->isbn }}<span></h6>
                @if ($book->year)
                    <h6>Year: <span class="fw-normal">{{ $book->year }}<span></h6>
                @endif
                <h6>Language: <span class="fw-normal">{{ $book->language }}<span></h6>
                @if ($book->width && $book->height && $book->length)
                    <h6>Size: <span
                            class="fw-normal">{{ $book->width . ' x ' . $book->height . ' x ' . $book->length }}<span>
                    </h6>
                @endif
                @if ($book->pages)
                    <h6>Pages: <span class="fw-normal">{{ $book->pages }}<span></h6>
                @endif
            </div>
            <div class="book-details-shop p-3 text-center">
                @unless ($book->calcQuantity() == 0)
                    <button class="d-block border-0 p-3 px-5 mb-4 w-100 rounded-2 bg-accent text-white text-decoration-none fw-semibold"
                         id="add-bag" data-book-id="{{ $book->id }}">
                        Add to bag <i class="fa-solid fa-bag-shopping ms-2"></i>
                    </button>
                    <button class="d-block border-0 p-3 px-5 mb-1 w-100 rounded-2 bg-secondary text-white text-decoration-none fw-semibold"
                         id="buy">
                        Buy Now <i class="fa-solid fa-bag-shopping ms-2"></i>
                    </button>
                    <h6 class="mb-3 fw-light">Available: {{ $book->calcQuantity() }}</h6>

                    <div class="w-100 mt-2 mb-4 justify-content-center number-input-wrapper">
                        <button class="number-input-button first" data-btn-quantity="-">-</button>
                        <input class="number-input-number text-center" type="number" min="1" id="quantity"
                            max="{{ $book->calcQuantity() }}" value="1">
                        <button class="number-input-button last" data-btn-quantity="+">+</button>
                    </div>

                    @if ($book->onSale())
                        <h5 class="text-decoration-line-through text-dead">USD{{ $book->calcBasePrice() }}</h5>
                        <h3 class="mt-2 fw-bold">USD{{ $book->calcPrice() }}</h3>

                        <span class="py-1 px-2 m-1 bg-secondary fw-bold text-white rounded-2">
                            {{ $book->calcDiscount() }}%
                        </span>
                    @else
                        <h3 class="mt-2 fw-bold">USD{{ $book->calcPrice() }}</h3>
                    @endif
                @else
                    <a class="d-block p-3 px-5 mb-4 rounded-2 btn-dead text-white text-decoration-none fw-semibold"
                        href="#button">
                        Unavailable</i>
                    </a>
                @endunless
            </div>
        </div>


        <h6>Posted at: <span class="fw-normal">{{ date_format($book->created_at, 'Y/m/d, h:i') }}h<span></h6>
        <h6>Updated at: <span class="fw-normal">{{ date_format($book->updated_at, 'Y/m/d, h:i') }}h<span></h6>

        @if ($book->description)
            <p id="description">{{ $book->description }}</p>
        @else
            <p id="description" class="text-dead">No description.</p>
        @endif

        <hr>


        <div class="d-flex flex-column justify-content-center align-items-center">
            <div class="d-flex justify-content-center align-items-center mb-4">
                <h2 class="m-0">{{ round($book->getRating(), 2) }}</h2>
                <div class="stars-full d-block" style="--height: 2.5rem; --rating: {{ $book->getRating() }}%">
                    <img class="stars-empty" src="/img/site/stars-empty.png">
                </div>
            </div>
            <div class="col-12 col-lg-6">
                @for ($i = 5; $i > 0; $i--)
                    <div class="d-flex">
                        {{ $i }}stars
                        <div class="stars-percent-holder" style="--percent:{{ $book->getEvalsPerStar($i) * 100 }}%"
                            title="{{ $book['rating_' . $i] }}">
                            <div class="stars-percent">
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </section>



    <div>
        @include('layouts.book.book-collection', [
            'name' => 'Same Author',
            'collection' => $book->author->books,
        ])
        @include('layouts.book.book-collection', [
            'name' => 'Same Publisher',
            'collection' => $book->publisher->books,
        ])
        @include('layouts.book.book-collection', [
            'name' => 'Same Genre',
            'collection' => $book->genre->books,
        ])
    </div>
@endsection
