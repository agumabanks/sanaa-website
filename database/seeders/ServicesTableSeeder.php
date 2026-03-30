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
        Service::truncate();

        $services = [
            [
                'name' => 'Sanaa Finance Implementation',
                'description' => 'Complete deployment of Sanaa Finance for SACCOs, MFIs, and money lenders. Includes data migration, system configuration, staff training, and go-live support. We digitise your member management, loan origination, collections, and URBRA compliance reporting.',
                'icon' => 'fas fa-university',
                'price' => null, // Custom pricing
                'active' => true,
            ],
            [
                'name' => 'Soko24 POS & Marketplace Setup',
                'description' => 'End-to-end setup of Soko24 point-of-sale system for retailers and SMEs. Hardware installation, inventory configuration, pricing structure, staff training, and connection to the Soko24 marketplace for online sales.',
                'icon' => 'fas fa-cash-register',
                'price' => null,
                'active' => true,
            ],
            [
                'name' => 'Digital Transformation for SACCOs',
                'description' => 'Strategic consulting and implementation for SACCOs looking to modernise. Process mapping, digitisation roadmap, change management, and staff capacity building. Move from paper and WhatsApp to a fully digital operation.',
                'icon' => 'fas fa-sync-alt',
                'price' => null,
                'active' => true,
            ],
            [
                'name' => 'School & Education Programs',
                'description' => 'Complete education technology deployment including computer labs with Matic devices, EduOS school management system, digital fee collection, and teacher training programs. From kindergarten to university.',
                'icon' => 'fas fa-graduation-cap',
                'price' => null,
                'active' => true,
            ],
            [
                'name' => 'Logistics & Corridor Design',
                'description' => 'Courier process digitisation, warehouse management, and route planning using the Baraka logistics platform. Specialised in Uganda-DRC corridors and Asia-to-Africa import/export visibility.',
                'icon' => 'fas fa-truck',
                'price' => null,
                'active' => true,
            ],
            [
                'name' => 'Device Deployment & Support',
                'description' => 'Hardware rollout services for laptops, tablets, POS terminals, and custom devices. Includes procurement, configuration, deployment logistics, warranty support, and field engineer maintenance across all 134 Ugandan districts.',
                'icon' => 'fas fa-laptop',
                'price' => null,
                'active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
