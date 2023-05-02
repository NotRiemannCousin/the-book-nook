<?php

namespace App\Models;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasOne};
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'language',

        'price',
        'sold',
        'quantity',

        'image',
        'weight',
        'width',
        'height',
        'length',

        'pages',
        'isbn',
        'year',

        'genre_id',
        'author_id',
        'publisher_id',

        'rating_1',
        'rating_2',
        'rating_3',
        'rating_4',
        'rating_5'
    ];

    protected $casts = [
        'price' => 'float',
        'sold' => 'integer',
        'quantity' => 'integer',

        'pages' => 'integer',
        'year' => 'integer',

        'rating_1' => 'integer',
        'rating_2' => 'integer',
        'rating_3' => 'integer',
        'rating_4' => 'integer',
        'rating_5' => 'integer'
    ];
    
    public function sale(): HasOne
    {
        return $this->hasOne(Sale::class);
    }
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }
    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }
    public function publisher(): BelongsTo
    {
        return $this->belongsTo(Publisher::class);
    }



    public function getRating()
    {
        return ($this->rating_5 * 5 + $this->rating_4 * 4 + $this->rating_3 * 3 + $this->rating_2 * 2 + $this->rating_1) / $this->getTotalEvals();
    }
    public function getTotalEvals()
    {
        return $this->rating_5 + $this->rating_4 + $this->rating_3 + $this->rating_2 + $this->rating_1;
    }
    public function getEvalsPerStar(int $star_number)
    {
        return $this['rating_' . $star_number] / $this->getTotalEvals();
    }
    public function calcPrice()
    {
        if ($this->onSale())
            return round((1 - $this->sale->percentage) * $this->price, 2);

        return $this->calcBasePrice();
    }
    public function calcBasePrice()
    {
        return round($this->price, 2);
    }
    public function onSale()
    {
        return (bool)$this->sale;
    }
    public function calcQuantity()
    {
        return max(0, $this->quantity - $this->sold);
    }



    public static function random($limit = 5)
    {
        return self::select()->inRandomOrder()->take($limit)->get();
    }
    public static function getTop10()
    {
        static $rating = '(rating_5 * 5 + rating_4 * 4 + rating_3 * 3 + rating_2 * 2 + rating_1)/' .
            '(rating_5 + rating_4 + rating_3 + rating_2 + rating_1)';

        // return self::selectRaw("*, $rating AS rating")->orderByDesc('rating')->take(10)->get();
        return self::selectRaw("*, $rating AS rating")->orderByDesc('rating')->take(10)->get();
    }
    public static function getMostRecents()
    {
        return self::select()->orderByDesc('created_at')->take(10)->get();
    }
    public static function getBestSellers()
    {
        return self::select()->orderByDesc('sold')->take(10)->get();
    }
}
