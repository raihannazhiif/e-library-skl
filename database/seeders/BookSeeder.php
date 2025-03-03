<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 40 data di Book
        Book::factory(40)->create();
        
        // Book::factory()->create([
        //     "title" => fake()->name(),
        //     "slug" => fake()->slug(),
        //     "description" => fake()->text(),
        //     "page_count" => fake()->randomNumber(),
        //     "author" => fake()->name(),
        //     "published_year" => fake()->year(),
        // ]);
    }
}
