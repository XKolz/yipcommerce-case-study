<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@yipdemo.com'],
            [
                'name' => 'YipCommerce Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ],
        );

        User::query()->updateOrCreate(
            ['email' => 'user@yipdemo.com'],
            [
                'name' => 'YipCommerce Customer',
                'password' => Hash::make('password'),
                'role' => 'user',
            ],
        );
    }
}
