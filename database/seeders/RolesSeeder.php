<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\User::where('email', 'admin@example.com')->update(['role' => 'admin']);
        \App\Models\User::where('email', 'manager@example.com')->update(['role' => 'manager']);
    }
}
