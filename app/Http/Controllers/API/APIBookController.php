<?php

namespace App\Http\Controllers\API;

use App\Models\Book;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Http\Requests\CreateUpdateBookRequest;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class APIBookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::paginate(15);

        return $books;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUpdateBookRequest $request)
    {
        $data = $request->validated();
        $book = Book::create($data);

        return new BookResource($book);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return new BookResource($book);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateUpdateBookRequest $request, Book $book)
    {
        // $data = $request->validated();
        // $book = $data;

        // return new BookResource($book);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }
}
