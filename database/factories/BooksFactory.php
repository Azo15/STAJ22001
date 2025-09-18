<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Books>
 */
class BooksFactory extends Factory
{
    /**
     * Modelin varsayılan durumunu tanımlar.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'author' => $this->faker->name(),
            'release_date' => $this->faker->date(),
            'pages' => $this->faker->numberBetween(100, 1000),
            'isbn' => $this->faker->isbn13(),
            'description' => $this->faker->paragraph(),
            // 'genre' => $this->faker->randomElement(['Fiction', 'Mystery', 'Fantasy', 'Romance', 'Thriller', 'Horror']),
            'in_stock' => $this->faker->numberBetween(0, 50),
            'cover' => $this->faker->imageUrl(),
            'language' => $this->faker->languageCode(),
        ];
    }
}
