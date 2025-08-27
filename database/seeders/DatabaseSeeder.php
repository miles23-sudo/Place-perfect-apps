<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Customer;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Customer::factory(100)->create();
        $categories = ProductCategory::factory(10)->create();

        Product::factory(10)->create([
            'product_category_id' => fn() => $categories->random()->id
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password')
        ]);
    }
}
