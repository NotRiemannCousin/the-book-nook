<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Book, Genre, Author, Publisher};

class MainController extends Controller
{
    public function index()
    {


        $collections = [
            'Best Rating' => Book::Top10()->pick(10),
            'Best Sellers' => Book::BestSellers()->pick(10),
            'Most Recents' => Book::latest()->pick(10),
        ];
        $carousel = Book::inRandomOrder()->pick(5);

        $selected_book_by_genres = Genre::inRandomOrder()->pick(3);


        return view('main.index', [
            'collections' => $collections,
            'carousel' => $carousel,
            'selected_book_by_genres' => $selected_book_by_genres,
        ]);
    }
    public function about()
    {
        return view('main.about');
    }
    public function contact()
    {
        return view('main.contact');
    }
}