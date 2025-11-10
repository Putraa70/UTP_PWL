<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@himakom.com'],
            [
                'id'       => Str::uuid(),
                'name'     => 'Admin HIMAKOM',
                'password' => bcrypt('admin123'), // Password login
                'role'     => 'ADMIN',            // sesuai enum
                'npm'      => null,               // optional terenkripsi
                'no_hp'    => null,
            ]
        );
    }
}
