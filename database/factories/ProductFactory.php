<?php

namespace Database\Factories;
use Illuminate\Support\Facades\Date;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;


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

    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'product_name' => $this->faker->word,
            'seller_id' => $this->faker->numberBetween(1, 2),
            'category_id' => $this->faker->numberBetween(1, 10),
            'description' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'quantity' => $this->faker->numberBetween(1, 100),
            'sold' => $this->faker->numberBetween(0, 50),
            'img' => 'iphone-15.webp', // Giá trị cố định
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
