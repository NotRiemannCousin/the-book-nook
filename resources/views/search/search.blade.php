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

        <div class="col-12 col-md-8 col-lg-4">
            <div class="input-group p-1">
                <div class="input-group-prepend">
                    <div class="input-group-text">USD</div>
                </div>
                <input type="number" class="form-control" name="min_price" min="0" value="{{ $min_price ?? '' }}"
                    placeholder="Minimum Price">
            </div>
            <div class="input-group p-1">

                <div class="input-group-prepend">
                    <div class="input-group-text">USD</div>
                </div>
                <input type="number" class="form-control" name="max_price" min="0" value="{{ $max_price ?? '' }}"
                    placeholder="Maximum Price">
            </div>
            <div class="form-group p-1">
                <label for="rating">Min Rating: <span class="input-track-value"
                        for="rating">{{ $rating_value ?? '0' }}</span></label>
                <input type="range" class="form-range input-track-input" min="0" max="5"
                    value="{{ $rating_value ?? '0' }}" name="rating" step=".1">
            </div>
            <div class="form-group p-1">
                <label for="discount">Discount: <span class="input-track-value" for="discount"
                        data-suffix="%">{{ $rating_value ?? '0' }}</span></label>
                <input type="range" class="form-range input-track-input" min="0" max="60"
                    value="{{ $rating_value ?? '0' }}%" name="discount" step="10">
            </div>
            <script>
                $('.input-track-input').on('input', function() {
                    let input = $(this);
                    console.log(input.id);

                    if (!input.id)
                        return;


                    let value = $(`.input-track-value[for=${input.id}]`);

                    if (!value)
                        return;

                    $('').html(input.val() + input.attr('data-suffix'));
                });
            </script>
        </div>
        <div>
            <input type="submit" class="btn btn-primary">
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
