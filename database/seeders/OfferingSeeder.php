<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Offering;

class OfferingSeeder extends Seeder
{
    public function run(): void
    {
        Offering::truncate();

        $data = [
            [
                'title' => 'Soko 24',
                'type' => 'product',
                'description' => 'Africa\'s marketplace for authentic brands. Shop electronics, fashion, home essentials and more with fast delivery and secure payments.',
                'link' => 'https://soko.sanaa.co',
            ],
            [
                'title' => 'Sanaa Finance',
                'type' => 'service',
                'description' => 'Modern financial infrastructure for African businesses. Accept payments, manage cash flow, access working capital and grow faster.',
                'link' => 'https://sanaa.ug/finance',
            ],
            [
                'title' => 'Sanaa Media',
                'type' => 'service',
                'description' => 'Digital storytelling and content production for brands. Video, photography, social media management and creative campaigns.',
                'link' => 'https://media.sanaa.co',
            ],
            [
                'title' => 'Point of Sale',
                'type' => 'product',
                'description' => 'All-in-one POS system for retail, restaurants and services. Hardware, software and payments unified in one seamless experience.',
                'link' => '/services',
            ],
            [
                'title' => 'Developer Platform',
                'type' => 'service',
                'description' => 'APIs and SDKs to integrate Sanaa payments and commerce into your applications. Documentation, sandbox and developer support.',
                'link' => '/developer-platforms',
            ],
            [
                'title' => 'Business Banking',
                'type' => 'service',
                'description' => 'Business accounts with instant access to funds, real-time analytics and seamless integration with your Sanaa tools.',
                'link' => 'https://sanaa.ug/finance',
            ],
        ];

        foreach ($data as $item) {
            Offering::create($item);
        }
    }
}
