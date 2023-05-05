<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Genre extends Model
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

    #region  methods
    public function mainAuthors()
    {
        return Author::selectRaw('sum(books.sold) as count, authors.*')
            ->join('books', 'books.author_id', '=', 'authors.id')
            ->whereRaw('books.genre_id = ?', $this->id)
            ->groupBy('books.author_id')
            ->orderByRaw('sum(books.sold) DESC')
        ;
    }
    public function mainPublishers()
    {
        return Publisher::selectRaw('sum(books.sold) as count, publishers.*')
            ->join('books', 'books.publisher_id', '=', 'publishers.id')
            ->whereRaw('books.genre_id = ?', $this->id)
            ->groupBy('books.publisher_id')
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