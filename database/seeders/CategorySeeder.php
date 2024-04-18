<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Lifestyle',
            'Food',
            'Home',
            'Travel',
            'Astronomy',
            'Nature',
            'Cooking',
            'Fashion',
            'Wellness',
            'Dieting',
            'Fitness',
            'Technology',
            'Finance',
            'Art',
            'Photography',
            'Music',
            'Movies',
            'Books',
            'Gaming',
            'Sports',
        ];

        foreach ($categories as $category) {
            Category::create([
                'judul_kategori' => $category,
            ]);
        }
    }
}
