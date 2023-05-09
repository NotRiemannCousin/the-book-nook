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
        if (!$book)
            return redirect()->route('index');
        return view('details.book-details', ['book' => $book]);
    }



    public function author(Author $author)
    {
        if (!$author)
            return redirect()->route('index');

        $main_publishers = $author->mainPublishers()->pick();
        $main_publisher = optional($main_publishers[0]);

        $main_genres = $author->mainGenres()->pick();
        $main_genre = optional($main_genres[0]);


        return view(
            'details.author-details',
            [
                'author' => $author,
                'main_publishers' => $main_publishers,
                'main_publisher' => $main_publisher,
                'main_genres' => $main_genres,
                'main_genre' => $main_genre,
            ]
        );
    }



    public function publisher(Publisher $publisher)
    {
        if (!$publisher)
            return redirect()->route('index');

        $main_authors = $publisher->mainAuthors()->pick(3);
        $main_author = optional($main_authors[0]);

        $main_genres = $publisher->mainGenres()->pick(3);
        $main_genre = optional($main_genres[0]);


        return view(
            'details.publisher-details',
            [
                'publisher' => $publisher,
                'main_authors' => $main_authors,
                'main_author' => $main_author,
                'main_genres' => $main_genres,
                'main_genre' => $main_genre,
            ]
        );
    }



    public function genre(Genre $genre)
    {
        if (!$genre)
            return redirect()->route('index');

        $main_publishers = $genre->mainPublishers()->pick(3);
        $main_publisher = optional($main_publishers[0]);

        $main_authors = $genre->mainAuthors()->pick(3);
        $main_author = optional($main_authors[0]);


        return view(
            'details.genre-details',
            [
                'genre' => $genre,
                'main_publishers' => $main_publishers,
                'main_publisher' => $main_publisher,
                'main_authors' => $main_authors,
                'main_author' => $main_author,
            ]
        );
    }
}