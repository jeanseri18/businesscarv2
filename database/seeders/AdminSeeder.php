<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer l'admin s'il n'existe pas déjà
        User::firstOrCreate(
            ['email' => 'admin@yabara.com'],
            [
                'name' => 'Admin System',
                'phone' => '+221770000000',
                'country' => 'Sénégal',
                'nationality' => 'Sénégalaise',
                'accept_terms' => true,
                'role' => 'admin',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
            ]
        );

        // Créer quelques entreprises exemple
        User::firstOrCreate(
            ['email' => 'alpha@entreprise.com'],
            [
                'name' => 'Entreprise Alpha',
                'phone' => '+221781234567',
                'country' => 'Sénégal',
                'nationality' => 'Sénégalaise',
                'accept_terms' => true,
                'role' => 'entreprise',
                'password' => Hash::make('entreprise123'),
                'email_verified_at' => now(),
            ]
        );

        User::firstOrCreate(
            ['email' => 'junior@commercial.com'],
            [
                'name' => 'Commercial Junior',
                'phone' => '+221765432109',
                'country' => 'Sénégal',
                'nationality' => 'Sénégalaise',
                'accept_terms' => true,
                'role' => 'commercial',
                'password' => Hash::make('commercial123'),
                'email_verified_at' => now(),
            ]
        );
    }
}