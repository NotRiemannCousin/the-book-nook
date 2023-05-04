<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    use HasFactory;

    #region attributes

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];
    #endregion

    #region relations
    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }
    #endregion

    #region methods
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
    #endregion



    #region scopes
    public function scopeGetBestSellers($query)
    {
        return $query->where('publisher_id', '=', $this->id)->orderByDesc('sold')->take(10)->get();
    }
    public function scopeFilteredByName($query, $search_input)
    {
        if ($search_input) {
            return $query->whereLike('name', $search_input);
        }
        return $query;
    }
#endregion
}