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
            'product_category_id' => $this->faker->randomElement(ProductCategory::pluck('id')->toArray()),
            'name' => $name,
            'slug' => str()->slug($name),
            'price' => $this->faker->randomFloat(2, 1, 100),
            'short_description' => $this->faker->sentence(10),
            'description' => collect($this->faker->paragraphs(4))
                ->map(fn($p) => "### " . $this->faker->sentence() . "\n\n" . $p)
                ->implode("\n\n"),
            'features' => $features,
            'is_active' => $this->faker->boolean(),
        ];
    }
}
