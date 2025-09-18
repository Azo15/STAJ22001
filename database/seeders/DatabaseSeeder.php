<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Book;
use App\Models\Genre;

class DatabaseSeeder extends Seeder
{
    /**
     * Uygulamanın veritabanını tohumla.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test Kullanıcı',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('books')->delete();
        DB::table('genres')->delete();
        DB::table('rentals')->delete();
        DB::table('users')->delete();

        \App\Models\User::factory(10)->create();

        $this->call([
            GenreSeeder::class,
        ]);
        
        $this->call([
            BooksSeeder::class,
        ]);

        $this->call([
            RentalSeeder::class,
        ]);
    }
}
