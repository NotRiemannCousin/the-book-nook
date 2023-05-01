<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Genre extends Model
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
    public static function random($limit = 3)
    {
        return self::select()->inRandomOrder()->take($limit)->get();
    }
    public function mainAuthors()
    {
        return Author::selectRaw('sum(books.sold) as count, authors.*')
            ->join('books', 'books.author_id', '=', 'authors.id')
            ->whereRaw('books.genre_id = ?', $this->id)
            ->groupBy('books.author_id')
            ->orderByRaw('sum(books.sold) DESC')
            ->get();
    }
    public function mainPublishers()
    {
        return Publisher::selectRaw('sum(books.sold) as count, publishers.*')
            ->join('books', 'books.publisher_id', '=', 'publishers.id')
            ->whereRaw('books.genre_id = ?', $this->id)
            ->groupBy('books.publisher_id')
            ->orderByRaw('sum(books.sold) DESC')
            ->get();
    }
    public  function getBestSellers()
    {
        return Book::where('genre_id', '=', $this->id)->select()->orderByDesc('sold')->take(10)->get();
    }
}
