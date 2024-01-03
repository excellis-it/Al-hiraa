<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'main@yopmail.com',
            'password' => bcrypt('12345678'),
            'phone' => '1234567890',
            'city' => 'Ahmedabad',
            'state' => 'Gujarat',
            'country' => 'India',
            'account' => 'admin',
            'role_type' => 'ADMIN',
            'timezone' => 'Asia/Kolkata',
            'currency' => 'INR',
            'apllication_language' => 'en',
            'is_active' => true,
        ]);
        $admin->assignRole('ADMIN');
    }
}
