<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    /**
     * Veritabanı tohumlamasını çalıştır.
     */
    public function run(): void
    {
        \App\Models\Genre::factory(10)->create();
    }
}
