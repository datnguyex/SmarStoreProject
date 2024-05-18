<?php

namespace Database\Factories;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Order::class;
    public function definition(): array
    {
        return [
            'Order_Describe' => $this->faker->text,
            'customer_id' => $this->faker->numberBetween(1, 10),
            'TotalAmount' => $this->faker->randomFloat(2, 10, 1000), // Thay đổi phạm vi của tổng số tiền theo nhu cầu của bạn
            'PaymentMethod' => $this->faker->randomElement(['Credit Card', 'PayPal', 'Cash', 'Bank Transfer']),
            'PaymentStatus' => $this->faker->randomElement(['Completed', 'Failed']),
        ];
    }
}
