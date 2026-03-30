<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogCategory;
use Illuminate\Support\Str;

class BlogCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Technology',
                'description' => 'Latest trends in tech, software development, AI, and innovation',
                'color' => '#3B82F6',
            ],
            [
                'name' => 'Business',
                'description' => 'Entrepreneurship, startups, management, and business strategy',
                'color' => '#10B981',
            ],
            [
                'name' => 'Design',
                'description' => 'UI/UX design, product design, graphic design, and creative work',
                'color' => '#8B5CF6',
            ],
            [
                'name' => 'Programming',
                'description' => 'Coding tutorials, programming languages, and software engineering',
                'color' => '#EF4444',
            ],
            [
                'name' => 'Data Science',
                'description' => 'Machine learning, data analysis, statistics, and big data',
                'color' => '#F59E0B',
            ],
            [
                'name' => 'Product Management',
                'description' => 'Product strategy, roadmaps, and product development',
                'color' => '#EC4899',
            ],
            [
                'name' => 'Marketing',
                'description' => 'Digital marketing, SEO, content marketing, and growth hacking',
                'color' => '#06B6D4',
            ],
            [
                'name' => 'Career',
                'description' => 'Professional development, job hunting, and career growth',
                'color' => '#84CC16',
            ],
            [
                'name' => 'Productivity',
                'description' => 'Time management, tools, workflows, and efficiency tips',
                'color' => '#6366F1',
            ],
            [
                'name' => 'Leadership',
                'description' => 'Management, team building, and leadership skills',
                'color' => '#14B8A6',
            ],
            [
                'name' => 'Startup',
                'description' => 'Building and scaling startups, fundraising, and entrepreneurship',
                'color' => '#F97316',
            ],
            [
                'name' => 'Mobile Development',
                'description' => 'iOS, Android, React Native, and mobile app development',
                'color' => '#A855F7',
            ],
            [
                'name' => 'Web Development',
                'description' => 'Frontend, backend, full-stack development, and web technologies',
                'color' => '#0EA5E9',
            ],
            [
                'name' => 'DevOps',
                'description' => 'CI/CD, infrastructure, cloud computing, and deployment',
                'color' => '#64748B',
            ],
            [
                'name' => 'Artificial Intelligence',
                'description' => 'AI, machine learning, deep learning, and neural networks',
                'color' => '#7C3AED',
            ],
            [
                'name' => 'Cybersecurity',
                'description' => 'Security best practices, ethical hacking, and privacy',
                'color' => '#DC2626',
            ],
            [
                'name' => 'Blockchain',
                'description' => 'Cryptocurrency, Web3, smart contracts, and decentralization',
                'color' => '#059669',
            ],
            [
                'name' => 'Finance',
                'description' => 'FinTech, personal finance, investing, and financial technology',
                'color' => '#0891B2',
            ],
            [
                'name' => 'Health & Wellness',
                'description' => 'Mental health, work-life balance, and professional wellness',
                'color' => '#22C55E',
            ],
            [
                'name' => 'Writing',
                'description' => 'Writing tips, storytelling, and content creation',
                'color' => '#F472B6',
            ],
        ];

        foreach ($categories as $category) {
            BlogCategory::updateOrCreate(
                ['slug' => Str::slug($category['name'])],
                [
                    'name' => $category['name'],
                    'description' => $category['description'] ?? null,
                    'color' => $category['color'] ?? '#6B7280',
                ]
            );
        }

        $this->command->info('Blog categories seeded successfully!');
    }
}
