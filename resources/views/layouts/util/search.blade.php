<form action="/search/" method="get" @class([
    'h-100 d-none d-md-flex flex-column align-items-center focus-container' =>
        $style == 'hide-md',
    'd-flex d-md-none px-4 h-100 w-fill flex-column align-items-center focus-container' =>
        $style == 'w-fill'
])>

    <div class="d-flex mb-1 w-fill form-group">
        <input name="search" type="text" class="px-2 w-fill border-0 rounded-start-2" placeholder="Search for a book feature..."
            value="{{ $search_input ?? '' }}">
        <button type="submit" class="border-0 rounded-0 btn btn-primary rounded-end-2">
            <i class="fas fa-search"></i>
        </button>
    </div>
</form>
