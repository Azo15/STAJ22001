<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Rental;
use App\Models\User;
use App\Models\Books;
use Illuminate\Support\Facades\DB;
use App\Models\Genre;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rental>
 */
class RentalFactory extends Factory
{
    /**
     * Modelin varsayılan durumunu tanımlar.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $rentalRequestedAt = fake()->dateTimeBetween('-1 year', 'now');
        $rentalStartAt = fake()->dateTimeBetween($rentalRequestedAt, '+5 days');
        $rentalDueAt = fake()->dateTimeBetween($rentalStartAt, '+1 week');
        $user = User::query()->inRandomOrder()->first();
        $book = Books::query()->inRandomOrder()->first();

        return [
            'user_id' => $user->id,
            'books_id' => $book->id,
            'status' => fake()->randomElement(['Pending Review', 'Approved', 'Returned', 'Overdue', 'Cancelled']),
            'rental_requested_at' => $rentalRequestedAt,
            'rental_start_at' => $rentalStartAt,
            'rental_due_at' => $rentalDueAt,
            'returned_at' => $this->faker->boolean(70) ? fake()->dateTimeBetween($rentalStartAt, '+3 weeks') : null,
        ];
    }
}
