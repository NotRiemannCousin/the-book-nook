<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required|max:255',
        ],);


        return view(
            'search.search',
            [
                'search_input' => $request->get('search'),
                'checked_book' => $request->has('book'),
                'checked_author' => $request->has('author'),
                'checked_genre' => $request->has('genre'),
                'checked_publisher' => $request->has('publisher'),
            ]
        );
    }
}
