<?php

namespace Database\Factories;

use Illuminate\Support\Facades\Date;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\OrderDetail;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderDetail>
 */
class OrderDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = OrderDetail::class;

    public function definition(): array
    {
        return [
            'order_id' => $this->faker->numberBetween(1, 10),
            'product_id' => $this->faker->numberBetween(1, 10),
            'quantity' => $this->faker->numberBetween(1, 3),
            'seller_id' => $this->faker->numberBetween(1, 10),
            'price' => $this->faker->randomFloat(2, 10, 100), // Giá của sản phẩm
            'total' => $this->faker->numberBetween(1, 10), // Số lượng sản phẩm
            'created_at' => Date::now(),
            'updated_at' => Date::now()
        ];
    }
}
