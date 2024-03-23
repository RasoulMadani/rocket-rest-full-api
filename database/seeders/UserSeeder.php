<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->state([
            'first_name' => 'Admin',
            'last_name' => 'Admin pour',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678')
        ])->create();
        User::factory(100)->create();
    }
}
