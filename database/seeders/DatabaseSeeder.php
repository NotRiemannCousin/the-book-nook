<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AuthorSeeder::class,
            GenreSeeder::class,
            PublisherSeeder::class,
            BookSeeder::class,
            SaleSeeder::class
        ]);
    }
}
