<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Feedback;
use App\Enums\UserRole;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(100)->create();
        ProductCategory::factory(10)->create();
        Product::factory(500)->create();
        // Feedback::factory(1000)->create();


        User::factory()->create([
            'name' => 'Test User',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'role' => UserRole::Admin->value, // Assuming UserRole is an enum with Admin role
        ]);
    }
}
