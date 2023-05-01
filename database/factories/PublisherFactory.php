<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PublisherFactory extends Factory
{
    static $publishers = [
        "Starlight Press",
        "Moonbeam Books",
        "Redwood Publishing",
        "Silver Lake Media",
        "Emerald Editions",
        "Firefly Publications",
        "Blue Sky Press",
        "Willow Books",
        "Sunrise Publishing",
        "Blackbird Media",
        "Dreamcatcher Books",
        "Riverstone Press",
        "Golden Gate Publishing",
        "Nightfall Editions",
        "Sparkle Publications",
        "Greenleaf Books",
        "Snowflake Media",
        "Rainbow Press",
        "Twilight Publishing",
        "Starburst Books"
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
            'name' => $fake->unique()->randomElement(self::$publishers)
        ];
    }
}
