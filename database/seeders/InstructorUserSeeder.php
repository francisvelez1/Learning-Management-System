<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class InstructorUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'instructor@test.com'],
            [
                'name' => 'Test Instructor',
                'password' => Hash::make('password'),
                'role' => 'instructor',
            ]
        );
    }
}
