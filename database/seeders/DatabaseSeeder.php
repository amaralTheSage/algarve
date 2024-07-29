<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'display_name' => 'amaralTheSage',
            'username' => 'amaralTheSage',
            'email' => 'amaraldesouza9@gmail.com',
            'password' => 'topodopicodotrovao',
            'is_admin' => 1
        ]);
    }
}
