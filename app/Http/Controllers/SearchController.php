<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Book, Genre, Author, Publisher};

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required|max:255',
            'page' => 'integer'
        ]);
        $search_input = $request->get('search');

        $books = Book::FilteredByTitle($search_input)->paginate(30,  ['*'], 'page', $request->get('page') ?? 1);
        $books->appends(['search' => $search_input]);

        return view(
            'search.search',
            [
                'books' => $books,
                'search_input' => $search_input
            ]
        );
    }
}