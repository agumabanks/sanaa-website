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
                'description' => 'Our online shopping destination with authentic brands and essentials.',
                'link' => 'https://soko.sanaa.co',
            ],
            [
                'title' => 'Sanaa Fi',
                'type' => 'service',
                'description' => 'Reliable financial solutions for businesses across Africa.',
                'link' => 'https://fin.sanaa.co',
            ],
            [
                'title' => 'Sanaa Media',
                'type' => 'service',
                'description' => 'Helping creators build digital media brands across the continent.',
                'link' => 'https://media.sanaa.co',
            ],
        ];

        foreach ($data as $item) {
            Offering::create($item);
        }
    }
}
