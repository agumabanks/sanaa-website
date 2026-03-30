<?php

namespace Database\Seeders;

use App\Models\DomainSetting;
use Illuminate\Database\Seeder;

class DomainSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $domains = [
            ['key' => 'main_domain', 'domain' => 'sanaa.ug'],
            ['key' => 'soko_domain', 'domain' => 'soko.sanaa.co'],
            ['key' => 'media_domain', 'domain' => 'media.sanaa.co'],
            ['key' => 'finance_domain', 'domain' => 'fi.sanaa.co'],
        ];

        foreach ($domains as $domain) {
            DomainSetting::updateOrCreate(
                ['key' => $domain['key']],
                ['domain' => $domain['domain'], 'is_active' => true]
            );
        }
    }
}
