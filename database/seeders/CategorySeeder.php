<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory()
            ->count(10)
            ->afterCreating(function ($category) {
                $postAmount = rand(0, 25);
                $category->posts()->createMany(
                    Post::factory()->count($postAmount)->make()->toArray()
                );
            })
            ->create();
    }
}
