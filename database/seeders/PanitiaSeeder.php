<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class PanitiaSeeder extends Seeder
{
    public function run()
    {
        $panitia = [
            [
                'name' => 'Putra',
                'email' => 'putra@himakom.com',
            ],
            [
                'name' => 'Nicho Dakkar Putra',
                'email' => 'nicho@himakom.com',
            ],
            [
                'name' => 'Bayu Ardi Ramadhani',
                'email' => 'bayu@himakom.com',
            ],
            [
                'name' => 'Satria Bima Bagaskara',
                'email' => 'satria@himakom.com',
            ],
        ];

        foreach ($panitia as $p) {
            User::create([
                'name' => $p['name'],
                'email' => $p['email'],
                'password' => bcrypt('password123'), // password default
                'role' => 'PANITIA',
                'npm' => encrypt('2317051098'), // dummy
                'no_hp' => encrypt('085371040111'), // dummy
            ]);
        }
    }
}
