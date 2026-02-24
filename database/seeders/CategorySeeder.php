<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Technology',
            'Programming',
            'Busincess',
            'Health',
            'Travel',
            'Education',
        ];

        foreach ($categories as $category) {
                Category::updateOrCreate(
                    ['slug' => 'technology'], // Look for this
                    ['name' => 'Technology']  // Update or Create with this
                );
        }
    }
}
