<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class GenreFactory extends Factory
{
    static $genres = [
        "Fantasy",
        "Adventure",
        "Romance",
        "Contemporary",
        "Dystopian",
        "Mystery",
        "Horror",
        "Thriller",
        "Paranormal",
        "Historical fiction",
        "Science Fiction",
        "Children’s",
        "Memoir",
        "Cookbook",
        "Art",
        "Self-help",
        "Development",
        "Motivational",
        "Health",
        "History",
        "Travel",
        "Guide / How-to",
        "Families & Relationships",
        "Humor"
    ];
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fake = fake();

        return [
            'name' => $fake->unique()->randomElement(self::$genres)
        ];
    }
}
