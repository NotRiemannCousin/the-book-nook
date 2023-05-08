@extends('layouts.main', ['main_width' => '-webkit-fill-available'])
@section('title', "Search: $search_input")


@section('content')
    <div class="p-2 px-5">
        <h2 class="d-inline me-3">{{ ucwords($search_input) }}</h2>
        <h4 class="d-md-inline text-muted"> {{ $books->total() }} matches</h4>
    </div>



    <form class="m-1 p-3 border rounded-3">
        <h5 class="px-3">Filters</h5>
        <input type="hidden" value="{{ $search_input }}">
        <div class="form-group">
            <div class="range-price">
                <div class="form-group p-1">
                    <label for="min">Min</label>
                    <input type="number" class="form-control" name="min_price" value="{{ $min_price ?? '' }}">
                </div>
                <div class="form-group p-1">
                    <label for="max">Max</label>
                    <input type="number" class="form-control" name="max_price" value="{{ $max_price ?? '' }}">
                </div>
                <div class="form-group p-1">
                <input type="checkbox">
                </div>
            </div>
        </div>
    </form>



    <section class="w-fill">
        @include('layouts.book.book-collection-expanded', [
            'collection' => $books,
        ])
    </section>





    <div class="d-flex justify-content-center">
        {!! $books->links() !!}
    </div>
@endsection
