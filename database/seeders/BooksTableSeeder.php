<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BooksTableSeeder extends Seeder
{
    public function run()
    {
        Book::create([
            'title' => 'Sample Book Title',
            'authors' => 'Author Name',
            'description' => 'Description of the book.',
            'released_at' => now()->subYear(),
            'cover_image' => null,
            'pages' => 300,
            'language_code' => 'en',
            'isbn' => '978-3-16-148410-0',
            'in_stock' => 5,
        ]);
        // If needed I can add more books
    }
}

