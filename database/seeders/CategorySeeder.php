<?php

namespace Database\Seeders;

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
            [
                'name' => 'Berita',
                'color' => '#0000FF' // Blue,
            ],
            [
                'name' => 'Informasi',
                'color' => '#FFA500' // Orange
            ],
        ];

        foreach ($categories as $category) {
            \App\Models\Category::insert($category);
        }
    }
}
