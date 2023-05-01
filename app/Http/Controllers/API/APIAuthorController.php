<?php

namespace App\Http\Controllers\API;

use App\Models\Author;
use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorResource;
use Illuminate\Http\Request;

class APIAuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //paginate and send json;
        $authors = Author::paginate(15);

        return $authors;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        return ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {
        response()->json();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
    }
}
