<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    public function definition(): array
    {
        $brands = ['Gucci', 'Prada', 'Nike', 'Adidas', 'Balenciaga', 'Louis Vuitton', 'Versace', 'Yeezy', 'Jordan', 'Off-White'];
        $shoeTypes = ['Sneakers', 'Loafers', 'Sandals', 'Boots', 'Running Shoes', 'Heels'];

        return [
            'name' => $this->faker->randomElement($brands) . ' ' . $this->faker->randomElement($shoeTypes),
            'brand' => $this->faker->randomElement($brands),
            'price' => $this->faker->numberBetween(200, 2000), // fancy prices 💸
            'stock' => $this->faker->numberBetween(5, 50),
            'description' => $this->faker->sentence(12),
        ];
    }
}
