<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Product;
use App\Models\Whatsapp;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Whatsapp::create([
            'name' => 'wa',
            'status' => 0
        ]);

        Category::create([
            'name' => 'Fruits'
        ]);

        Category::create([
            'name' => 'Vegetables'
        ]);

        Product::factory(5)->create();
    }
}
