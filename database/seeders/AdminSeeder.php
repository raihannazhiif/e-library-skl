<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::factory()->create([
            'name' => 'Atmin Perpus',
            'email' => 'atmin@admin.com',
            'password' => bcrypt('12345678'),
            'role' => 'admin'
        ]);
    }
}
