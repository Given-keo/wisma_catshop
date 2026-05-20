<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {User::create([
            'name' => 'Admin Wisma CatShop',
            'email' => 'admin@catshop.com',
            'whatsapp' => '087776048999', 
            'address' => 'Wisma Mas 2 Blok F2 No.20 Kutajaya Pasar Kemis Tangerang', 
            'role' => 'admin',
            'password' => Hash::make('catshop123'),
            'email_verified_at' => now(),
        ]);

    }
}
