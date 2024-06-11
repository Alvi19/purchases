<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Officer User',
            'email' => 'officer@example.com',
            'status' => 'officer',
            'password' => Hash::make('password'),
        ]);

        // Create a user with 'manager' status
        User::create([
            'name' => 'Manager User',
            'email' => 'manager@example.com',
            'status' => 'manager',
            'password' => Hash::make('password'),
        ]);

        // Create a user with 'finance' status
        User::create([
            'name' => 'Finance User',
            'email' => 'finance@example.com',
            'status' => 'finance',
            'password' => Hash::make('password'),
        ]);
    }
}
