<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\Customer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Feedback>
 */
class FeedbackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => $this->faker->randomElement(Customer::pluck('id')->toArray()),
            'product_id' => $this->faker->randomElement(Product::pluck('id')->toArray()),
            'rating' => $this->faker->numberBetween(1, 5),
            'comment' => $this->faker->sentence(),
            'response' => $this->faker->optional()->sentence(),
            'response_at' => $this->faker->optional()->dateTime(),
        ];
    }
}
