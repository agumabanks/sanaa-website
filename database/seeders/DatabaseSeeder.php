<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\BlogSeeder;
use Database\Seeders\TeamMemberSeeder;
use Database\Seeders\OfferingSeeder;
use Database\Seeders\ServicesTableSeeder;
use Database\Seeders\LandingPageSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        if (!User::where('email', 'test@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
        }

        $this->call([
            AdminUserSeeder::class,
            BlogSeeder::class,
            TeamMemberSeeder::class,
            ServicesTableSeeder::class,
            OfferingSeeder::class,
            FinanceSeeder::class,
            LandingPageSeeder::class,
        ]);
    }
}
