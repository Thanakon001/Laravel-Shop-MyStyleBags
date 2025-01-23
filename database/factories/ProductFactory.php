<?php

namespace Database\Factories;

use App\Models\Band;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "pro_bacode" => $this->faker->unique()->numerify('PRO#####'),
            "pro_name" => $this->faker->word(),
            "band_id" => Band::inRandomOrder()->value("band_id"),
            "pro_image" => file_get_contents(storage_path('app/public/png.png')),
            "pro_details" => $this->faker->sentence(20),
            "pro_price" => $this->faker->randomFloat(2, 0, 349),
            "pro_stock" => $this->faker->numberBetween(0, 100),
        ];
    }
}
