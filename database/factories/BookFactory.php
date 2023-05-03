<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Genre;
use App\Models\Sale;
use App\Models\Publisher;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BookFactory extends Factory
{
    static $names = [
        "Magic New Sons",
        "Magic Fire",
        "All Magic Tunnel",
        "Four Magic Search",
        "Magic House",
        "Magic Archbishop",
        "Magic Blindness",
        "Magic Cat's Whale",
        "Magic Stranger",
        "Magic Rose Whale",
        "Rose Magic Cancer",
        "Magic Darconville's Prejudice",
        "Magic Cat's Hundred",
        "Magic Tenth Prejudice",
        "Lost Love Sons",
        "Revisited Love House",
        "Scarlet Love God",
        "Revisited Love Heart",
        "Love Illusions",
        "Love New Gift",
        "New Love Wrath",
        "Love Revisited World",
        "Infinite Love Tunnel",
        "Love Infinite Sighs",
        "Rose Love Sons",
        "Love American Search",
        "American Love History",
        "Love Master Mountain",
        "New Love March",
        "Rage Plague",
        "Cat's Rage Life",
        "Scarlet Rage Souls",
        "Lonely Rage Eyes",
        "Tropic Rage Bridge",
        "Cat's Rage Falcon",
        "American Rage Light",
        "Rage Fall",
        "Rage Man",
        "Fair Rage Fall",
        "Rage Name",
        "Invisible Rage War",
        "Rage Years",
        "Rage Brave Eye",
        "Rage Tropic One",
        "Rage Tunnel",
        "Jazz Rage Fury",
        "Rage All Men",
        "Generic Plague",
        "Scarlet Generic Light",
        "Generic Tin Gift",
        "Generic Life",
        "Generic War",
        "Die Dead Bridge",
        "Tropic Die Blood",
        "Die American Blindness",
        "Die Drum",
        "East Die Falcon",
        "Die Mice",
        "Four Die Cities",
        "Rye Die Metamorphosis",
        "Brave Die Prejudice",
        "Brave Fantasy Gift",
        "Fantasy Bell",
        "Fantasy Solitude",
        "Quiet Fantasy Eyes",
        "Fantasy Jazz Peace",
        "Scarlet Fantasy Name",
        "Scarlet Fantasy Fury",
        "Fantasy Four Cities",
        "Fantasy Pale Adventures",
        "Fantasy Fair Vanity",
        "Four Fantasy Peace",
        "Fantasy Mockingbird",
        "Fantasy Master World",
        "Fantasy Brave Stranger",
        "Fantasy Lonely Lighthouse",
    ];
    static $min_price = 9.99;
    static $max_price = 199.99;

    static $min_pages = 10;
    static $max_pages = 999;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fake = fake();

        $quantity = $fake->randomNumber(3);

        $genre = Genre::inRandomOrder()->first();
        $author = Author::inRandomOrder()->first();
        $publisher = Publisher::inRandomOrder()->first();
        
        return [
            'title' => $fake->unique()->randomElement(self::$names),
            'subtitle' => $fake->sentence(5),
            'description' => $fake->text(1400),
            'language' => 'english',

            'price' => $fake->randomFloat(2, self::$min_price, self::$max_price),
            'sold' => $fake->numberBetween(0, $quantity),
            'quantity' => $quantity,
            
            // 'image',
            'weight' => $fake->randomFloat(1, 0.1, 4).'kg',
            'width' => $fake->numberBetween(12, 18).'cm',
            'height' => $fake->numberBetween(18, 25).'cm',
            'length' => $fake->randomFloat(1, 0.3, 4).'cm',
            'pages' => $fake->numberBetween(self::$min_pages, self::$max_pages),
            
            'isbn' => $fake->randomNumber(9),
            'year' => $fake->numberBetween($author->birth_year, ($author->birth_year ? $author->birth_year : date('Y'))),

            'genre_id' => $genre->id,
            'author_id' => $author->id,
            'publisher_id' => $publisher->id,
            // 'sale_id' => ($fake->randomDigit() == 9 ? Sale::newSale($this)->id: null),

            'rating_1' => $fake->randomNumber(1),
            'rating_2' => $fake->randomNumber(2),
            'rating_3' => $fake->randomNumber(4),
            'rating_4' => $fake->randomNumber(4),
            'rating_5' => $fake->randomNumber(4)
        ];
    }
}
