<form action="/search/" method="get" @class([
    'h-100 d-none d-md-flex flex-column align-items-center focus-container' =>
        $style == 'hide-md',
    'd-flex d-md-none px-4 h-100 w-fill flex-column align-items-center focus-container' =>
        $style == 'w-fill'
])>

    <div class="d-flex mb-1 w-fill form-group">
        <input name="search" type="text" class="px-2 w-fill border-0 rounded-start-2" placeholder="Book, author, genre or publisher"
            value="{{ $search_input ?? '' }}">
        <button type="submit" class="border-0 rounded-0 btn btn-primary rounded-end-2">
            <i class="fas fa-search"></i>
        </button>
    </div>
    <div class="d-flex form-group show-in-parent-focus">
        <label class="mx-2" for="book">Book: </label>
        <input class="form-check-input" name="book" type="checkbox" @checked($checked_book ?? true)>
        <label class="mx-2" for="author">Author: </label>
        <input class="form-check-input" name="author" type="checkbox" @checked($checked_author ?? false)>
        <label class="mx-2" for="publisher">Publisher: </label>
        <input class="form-check-input" name="publisher" type="checkbox" @checked($checked_publisher ?? false)>
        <label class="mx-2" for="genre">Genre: </label>
        <input class="form-check-input" name="genre" type="checkbox" @checked($checked_genre ?? false)>
    </div>
</form>
