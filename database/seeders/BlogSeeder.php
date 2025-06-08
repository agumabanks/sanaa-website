<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Blog;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Blog::truncate();

        $posts = [
            [
                'title' => 'Welcome to Sanaa',
                'excerpt' => 'Discover how Sanaa is building digital infrastructure across Africa.',
                'body' => 'Sanaa is focused on providing innovative solutions in commerce, finance and media.',
            ],
            [
                'title' => 'Building with Soko 24',
                'excerpt' => 'A look at our e-commerce platform and what it offers.',
                'body' => 'Soko 24 connects businesses and consumers with a seamless shopping experience.',
            ],
            [
                'title' => 'The future of finance with Sanaa Fi',
                'excerpt' => 'Simplifying payments and credit for businesses.',
                'body' => 'Sanaa Fi aims to make financial services accessible across the continent.',
            ],
        ];

        foreach ($posts as $data) {
            Blog::create([
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'excerpt' => $data['excerpt'],
                'body' => $data['body'],
            ]);
        }
    }
}
