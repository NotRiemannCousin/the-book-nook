<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];


    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }
    public function mainAuthors()
    {
        return Author::selectRaw('sum(books.sold) as count, authors.*')
            ->join('books', 'books.author_id', '=', 'authors.id')
            ->whereRaw('books.publisher_id = ?', $this->id)
            ->groupBy('books.author_id')
            ->orderByRaw('sum(books.sold) DESC')
            ->get();
    }
    public function mainGenres()
    {
        return Genre::selectRaw('sum(books.sold) as count, genres.*')
            ->join('books', 'books.genre_id', '=', 'genres.id')
            ->whereRaw('books.publisher_id = ?', $this->id)
            ->groupBy('books.genre_id')
            ->orderByRaw('sum(books.sold) DESC')
            ->get();
    }
    public  function getBestSellers()
    {
        return Book::where('publisher_id', '=', $this->id)->select()->orderByDesc('sold')->take(10)->get();
    }
}
