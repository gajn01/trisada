<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'user_type' =>0,
            'firstname' => 'Super',
            'midname' => '',
            'lastname' => 'Admin',
            'contact_no' => '1234567890',
            'img' => 'user.png',
            'address' => '123 Main St',
            'age' => 0,
            'birthday' => '1993-06-15',
            'email' => 'su@example.com',
            'username' => 'admin',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
        // You can create more users as needed
        // User::factory(10)->create();
    
    }
}