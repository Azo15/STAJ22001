<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Genre>
 */
class GenreFactory extends Factory
{
    /**
     * Modelin varsayılan durumunu tanımlar.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $genres = [
            'Fiction', 'Mystery', 'Fantasy', 'Romance', 'Thriller', 'Horror', 
            'Biography', 'Non-Fiction', 'Science Fiction', 'Historical',
            'Young Adult', 'Children', 'Crime', 'Self Help', 'Health',
            'Travel', 'Science', 'History', 'Poetry', 'Art', 'Cookbooks',
            'Diary', 'Journal', 'Prayer', 'Religion', 'Textbook',
            'True Crime', 'Review', 'Music', 'Guide', 'Math'
        ];
    
        return [
            'name' => $this->faker->unique()->randomElement($genres),
            'style' => $this->faker->randomElement(['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark']),
        ];
    }
}
