<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fake = fake();
        $min_age = 20;
        $max_age = 90;
        $cur_date = (int)date('Y');

        $birth_year = $fake->numberBetween(1500, $cur_date - $min_age);
        $death_age  = $fake->numberBetween($min_age, $max_age);

        $death_year = $birth_year + $death_age;

        $is_dead = ($death_year > $cur_date ? null : $death_year);
        
        return [
            'name' => $fake->name(),
            'birth_year' => $birth_year,
            'death_year' => $is_dead
        ];
    }
}
