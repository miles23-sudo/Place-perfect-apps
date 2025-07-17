<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductCategory>
 */
class ProductCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->words(3, true) . ' ' . str()->random(5);
        return [
            'image' => 'https://via.placeholder.com/1920x1080?text=Category+' . $name,
            'name' => $name,
            'slug' => str()->slug($name),
            'description' => $this->faker->sentence(),
        ];
    }
}
