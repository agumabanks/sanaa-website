<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $email = env('ADMIN_EMAIL', 'admin@example.com');
        $password = env('ADMIN_PASSWORD', 'password');

        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name' => 'Administrator',
                'password' => Hash::make($password),
                'is_admin' => true,
            ]
        );

        if (! $user->is_admin) {
            $user->forceFill(['is_admin' => true])->save();
        }

        // Ensure requested admin account exists (banks@sanaa.ug)
        // Updates password and admin flag if user already exists.
        $banks = User::updateOrCreate(
            ['email' => 'banks@sanaa.ug'],
            [
                'name' => 'Sanaa Admin',
                'password' => Hash::make('@sanaa.ug1001'),
                'is_admin' => true,
            ]
        );
        if (! $banks->is_admin) {
            $banks->forceFill(['is_admin' => true])->save();
        }
    }
}
