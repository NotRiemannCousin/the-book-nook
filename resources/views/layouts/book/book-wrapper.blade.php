<div class="m-1 p-4 border rounded-2">
    <a class="text-decoration-none text-reset" href="{{ route('details-book', ['book' => $book->id]) }}">
        <div class="mb-3 w-100 zoom-container">
            <img class="w-100 zoom-hover-1" src="{{ file_exists($book->image) ? $book->image : '/img/default-book.png' }}"
                {{-- style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis" --}} alt="{{ $book->title }}">
        </div>
        <h4 class="text-truncate" style="height: 1.3em" title="{{ $book->title }}">{{ $book->title }}</h4>
        <p class="text-truncate">{{ $book->author->name }}</p>

        @if ($book->onSale())
            <h6 class="text-truncate">
                <span class="text-decoration-line-through opacity-75">
                    U${{ $book->calcBasePrice() }}
                </span>
                U${{ $book->calcPrice() }}
            </h6>
        @else
            <h6 class="text-truncate">
                U${{ $book->calcPrice() }}
            </h6>
        @endif
    </a>
    <h6 class="text-truncate font-weight">
        <div class="stars-full" style="--rating: {{ $book->getRating() }}%" title="{{ round($book->getRating(), 2) }}">
            <img class="stars-empty" src="/img/site/stars-empty.png">
        </div>
    </h6>
    @if ($book->onSale())
        <span class="py-1 px-2 m-1 bg-secondary fw-bold text-white rounded-2">
            {{ $book->calcDiscount() }}%
        </span>
    @endif
</div>
