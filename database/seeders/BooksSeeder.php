<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Book;
use App\Models\Genre;

class BooksSeeder extends Seeder
{
    /**
     * Veritabanı tohumlamasını çalıştır.
     */
    public function run(): void
    {
        $genres = Genre::all();

        \App\Models\Books::factory(20)->create()->each(function ($book) use ($genres) 
        {
            // Her kitaba rastgele tür(ler) iliştir
            $book->genres()->attach(
                $genres->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
