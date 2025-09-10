<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Content Generation',
                'description' => 'AI-powered content creation for blogs, social media, marketing materials, and more. Generate high-quality, engaging content that resonates with your audience.',
                'icon' => 'fas fa-pen-fancy',
                'price' => 99.99,
                'active' => true,
            ],
            [
                'name' => 'Web Development',
                'description' => 'Custom web development services including responsive websites, e-commerce platforms, and web applications built with modern technologies.',
                'icon' => 'fas fa-code',
                'price' => 499.99,
                'active' => true,
            ],
            [
                'name' => 'Digital Consulting',
                'description' => 'Strategic digital transformation consulting to help businesses leverage technology for growth, efficiency, and competitive advantage.',
                'icon' => 'fas fa-chart-line',
                'price' => 199.99,
                'active' => true,
            ],
            [
                'name' => 'AI Integration',
                'description' => 'Seamlessly integrate artificial intelligence capabilities into your existing systems and workflows to enhance productivity and decision-making.',
                'icon' => 'fas fa-brain',
                'price' => 299.99,
                'active' => true,
            ],
            [
                'name' => 'Data Analytics',
                'description' => 'Advanced data analytics services to extract insights from your data, create dashboards, and drive data-informed business decisions.',
                'icon' => 'fas fa-chart-bar',
                'price' => 149.99,
                'active' => true,
            ],
            [
                'name' => 'Mobile App Development',
                'description' => 'Native and cross-platform mobile application development for iOS and Android, delivering exceptional user experiences.',
                'icon' => 'fas fa-mobile-alt',
                'price' => 799.99,
                'active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}