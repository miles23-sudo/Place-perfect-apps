<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ProductCategory;

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
        $name = $this->faker->word() . str()->random(5);
        $features = collect(range(1, rand(3, 6)))
            ->mapWithKeys(fn() => [
                ucfirst($this->faker->word()) => $this->faker->sentence(3),
            ])
            ->toArray();

        return [
            'product_category_id' => ProductCategory::factory(),
            'images' => 'https://via.placeholder.com/1920x1080?text=Product+' . $name,
            // 'ar_image' => $this->faker->image(public_path('product-ar-images'), 1920, 1080, null, false),
            'name' => $name,
            'slug' => str()->slug($name),
            'price' => $this->faker->randomFloat(2, 1, 100),
            'description' => $this->faker->sentence(),
            'features' => $features,
            'is_active' => $this->faker->boolean(),
        ];
    }
}
