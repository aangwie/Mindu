<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
        ['email' => 'admin@psikotest.com'],
        [
            'name' => 'admin',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'full_name' => 'Administrator Utama',
            'school_origin' => 'Sistem Pusat',
            'phone' => '08123456789',
        ]
        );

        User::updateOrCreate(
        ['email' => 'wirawan.aang5@gmail.com'],
        [
            'name' => 'Aang Wirawan',
            'password' => Hash::make('A4n6w!r4w4n'),
            'role' => 'admin',
            'full_name' => 'Aang Wirawan',
            'school_origin' => 'Sistem Pusat',
            'phone' => '081234084994',
            'is_active' => true,
        ]
        );

        // Add a sample student for testing
        User::updateOrCreate(
        ['email' => 'putri@gmail.com'],
        [
            'name' => 'putri',
            'password' => Hash::make('12344321'),
            'role' => 'student',
            'full_name' => 'Putri Anjani',
            'school_origin' => 'SMP Negeri 1 Testing',
            'phone' => '08987654321',
            'is_active' => true,
        ]
        );
    }
}
