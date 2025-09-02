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
        Blog::query()->delete();

        $posts = [
            [
                'title' => 'Welcome to Sanaa',
                'excerpt' => 'Discover how Sanaa is building digital infrastructure across Africa.',
                'body' => 'Sanaa is focused on providing innovative solutions in commerce, finance and media.',
                'status' => 'published',
                'published_at' => now(),
            ],
            [
                'title' => 'Building with Soko 24',
                'excerpt' => 'A look at our e-commerce platform and what it offers.',
                'body' => 'Soko 24 connects businesses and consumers with a seamless shopping experience.',
                'status' => 'published',
                'published_at' => now(),
            ],
            [
                'title' => 'The future of finance with Sanaa Fi',
                'excerpt' => 'Simplifying payments and credit for businesses.',
                'body' => 'Sanaa Fi aims to make financial services accessible across the continent.',
                'status' => 'published',
                'published_at' => now(),
            ],
            [
                'title' => 'Sanaa Finance Launches Buy Now Pay Later for Smartphones via Soko 24',
                'excerpt' => 'Revolutionary financing solution makes premium smartphones accessible to everyone.',
                'body' => 'Sanaa Finance has partnered with Soko 24 to launch an innovative Buy Now Pay Later service specifically designed for smartphone purchases. This groundbreaking initiative aims to make high-quality mobile devices accessible to a broader segment of the population across Africa.

The service allows customers to purchase smartphones from Soko 24 and pay in convenient installments over 3, 6, or 12 months with 0% interest for the first 6 months. This eliminates financial barriers and brings premium technology within reach of more consumers.

Key features of the program include:
- Instant approval process
- Flexible payment terms
- No hidden fees
- Credit building opportunities
- Seamless integration with Soko 24 platform

This launch represents a significant step forward in financial inclusion and digital access across the continent.',
                'status' => 'published',
                'published_at' => now(),
                'featured' => true,
            ],
            [
                'title' => 'Harnessing Media and Finance: Building a Digital Africa',
                'excerpt' => 'Exploring the intersection of digital media and financial services in transforming African economies.',
                'body' => 'The convergence of media and finance is creating unprecedented opportunities for digital transformation across Africa. Sanaa Co. is at the forefront of this revolution, leveraging innovative technologies to bridge the gap between traditional financial systems and modern digital media platforms.

Our integrated approach combines:
- Digital payment solutions
- Media content monetization
- Financial inclusion initiatives
- Technology infrastructure development

By harnessing the power of both media and finance, we are building a more connected and prosperous digital Africa that empowers businesses and individuals alike to thrive in the modern economy.',
                'status' => 'published',
                'published_at' => now(),
                'featured' => false,
            ],
        ];

        foreach ($posts as $data) {
            Blog::create([
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'excerpt' => $data['excerpt'],
                'body' => $data['body'],
                'status' => $data['status'] ?? 'published',
                'published_at' => $data['published_at'] ?? now(),
                'featured' => $data['featured'] ?? false,
            ]);
        }
    }
}
