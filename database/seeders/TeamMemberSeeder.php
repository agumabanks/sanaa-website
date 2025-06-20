<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TeamMember;

class TeamMemberSeeder extends Seeder
{
    public function run(): void
    {
        TeamMember::truncate();

        TeamMember::create([
            'name' => 'Aguma I. Banks',
            'title' => 'Founder & CEO',
            'bio' => 'Visionary leader building digital infrastructure across Africa.',
            'photo' => null,
        ]);
    }
}
