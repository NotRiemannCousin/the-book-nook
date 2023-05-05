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
            ;
    }
    public function mainGenres()
    {
        return Genre::selectRaw('sum(books.sold) as count, genres.*')
            ->join('books', 'books.genre_id', '=', 'genres.id')
            ->whereRaw('books.publisher_id = ?', $this->id)
            ->groupBy('books.genre_id')
            ->orderByRaw('sum(books.sold) DESC')
            ;
    }
    #endregion



    #region scopes
    public function scopeFilteredByName($query, $search_input)
    {
        if ($search_input) {
            return $query->whereLike('name', $search_input);
        }
        return $query;
    }
#endregion
}