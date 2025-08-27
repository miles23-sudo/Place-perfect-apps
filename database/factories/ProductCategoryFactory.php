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
        $name = fake()->unique()->word();
        $image = fake()->image(dir: storage_path('app/public/product-categories'), category: 'nature', fullPath: false);

        return [
            'image' => 'product-categories/' . basename($image),
            'name' => $name,
            'slug' => str()->slug($name),
            'short_description' => fake()->sentence(),
        ];
    }
}
