<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\BlogSeeder;
use Database\Seeders\TeamMemberSeeder;
use Database\Seeders\OfferingSeeder;
use Database\Seeders\ServicesTableSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call([
            BlogSeeder::class,
            TeamMemberSeeder::class,
            ServicesTableSeeder::class,
            OfferingSeeder::class,
        ]);
    }
}
