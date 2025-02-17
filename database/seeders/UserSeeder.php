<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'phone' => '9876543210',
                'password' => Hash::make('password123'),
                'role' => 2, // God role
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Landlord User',
                'email' => 'landlord@example.com',
                'phone' => '9876543211',
                'password' => Hash::make('password123'),
                'role' => 1, // Landlord role
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Normal User',
                'email' => 'user@example.com',
                'phone' => '9876543212',
                'password' => Hash::make('password123'),
                'role' => 0, // Regular user
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
