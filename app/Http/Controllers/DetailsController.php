<?php

namespace App\Http\Controllers;

use App\Models\{
    Book,
    Author,
    Publisher,
    Genre
};
use Illuminate\Http\Request;

class DetailsController extends Controller
{
    public function book(Book $book)
    {
        if ($book)
            return view('details.book-details', ['book' => $book]);
        return redirect()->route('index');
    }
    public function author(Author $author)
    {
        if ($author)
            return view('details.author-details', ['author' => $author]);
        return redirect()->route('index');
    }
    public function publisher(Publisher $publisher)
    {
        if ($publisher)
            return view('details.publisher-details', ['publisher' => $publisher]);
        return redirect()->route('index');
    }
    public function genre(Genre $genre)
    {
        if ($genre)
            return view('details.genre-details', ['genre' => $genre]);
        return redirect()->route('index');
    }
}
