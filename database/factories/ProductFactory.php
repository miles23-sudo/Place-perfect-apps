<?php

namespace Database\Factories;

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
        $name = fake()->unique()->word();

        return [
            'name' => $name,
            'slug' => str()->slug($name),
            'price' => fake()->randomFloat(2, 1, 1000),
            'short_description' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'features' => [
                fake()->word() => fake()->sentence(),
            ],

            'images' => [
                $this->generateImage(),
                $this->generateImage(),
                $this->generateImage(),
                $this->generateImage(),
            ],
        ];
    }

    private function generateImage(): string
    {
        return 'product-images/' . basename(fake()->image(dir: storage_path('app/public/product-images'), fullPath: false));
    }
}
