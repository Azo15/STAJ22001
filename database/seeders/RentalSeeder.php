<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Rental;
use App\Models\User;
use App\Models\Books;
use Illuminate\Support\Str;

class RentalSeeder extends Seeder
{
    /**
     * Veritabanı tohumlamasını çalıştır.
     */
    public function run(): void
    {
        $users = User::all();
        $books = Books::all();

        \App\Models\Rental::factory(30)->create();
    }
}
