<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Book;
use App\Models\Sale;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $book = Book::inRandomOrder()->first();

        return [
            // 'book_id' => $this->book_id,
            'book_id' => $book->id,
            'percentage' => .10,
            'until' => strtotime('+1 week')
        ];
    }
    // public function configure()
    // {
    //     return $this->afterCreating(function (Sale $sale) {
    //         $book = Book::find($sale->book_id);

    //         $book->sale_id = $sale->id;
    //         $book->save();
    //     });
    // } 
}
