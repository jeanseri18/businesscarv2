<?php

namespace Database\Seeders;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SouscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer tous les utilisateurs entreprise
        $entreprises = User::where('role', 'entreprise')->get();
        
        // Récupérer quelques utilisateurs normaux pour les souscriptions
        $users = User::where('role', 'user')->orWhere('role', 'entreprise')->limit(5)->get();

        $subscriptionTypes = [
            'junior' => ['price' => 50000, 'duration' => 3],
            'senior' => ['price' => 100000, 'duration' => 6],
            'manager' => ['price' => 150000, 'duration' => 9],
            'enterprise' => ['price' => 200000, 'duration' => 12],
        ];

        $sectors = [
            'Technologie',
            'Commerce',
            'Services',
            'Industrie',
            'Agriculture',
            'Tourisme',
            'Santé',
            'Éducation',
        ];

        $subSectors = [
            'Développement web',
            'Commerce général',
            'Services professionnels',
            'Manufacture',
            'Production agricole',
            'Hôtellerie',
            'Services médicaux',
            'Formation',
        ];

        // Créer des souscriptions pour les entreprises
        foreach ($entreprises as $entreprise) {
            $type = array_rand($subscriptionTypes);
            $subscriptionData = $subscriptionTypes[$type];
            
            $startDate = Carbon::now()->subMonths(rand(0, 12));
            $endDate = $startDate->copy()->addMonths($subscriptionData['duration']);

            Subscription::create([
                'user_id' => $entreprise->id,
                'type' => $type,
                'sector' => $sectors[array_rand($sectors)],
                'sub_sector' => $subSectors[array_rand($subSectors)],
                'duration_months' => $subscriptionData['duration'],
                'price' => $subscriptionData['price'],
                'payment_method' => ['credit_card', 'bank_transfer', 'mobile_money'][array_rand([0, 1, 2])],
                'payment_status' => ['paid', 'pending', 'failed'][array_rand([0, 1, 2])],
                'start_date' => $startDate,
                'end_date' => $endDate,
            ]);
        }

        // Créer des souscriptions pour les utilisateurs normaux
        foreach ($users as $user) {
            if ($user->role === 'user') {
                $type = 'junior'; // Utiliser junior pour les utilisateurs normaux
                $subscriptionData = $subscriptionTypes[$type];
                
                $startDate = Carbon::now()->subMonths(rand(0, 6));
                $endDate = $startDate->copy()->addMonths($subscriptionData['duration']);

                Subscription::create([
                    'user_id' => $user->id,
                    'type' => $type,
                    'sector' => $sectors[array_rand($sectors)],
                    'sub_sector' => $subSectors[array_rand($subSectors)],
                    'duration_months' => $subscriptionData['duration'],
                    'price' => $subscriptionData['price'],
                    'payment_method' => ['credit_card', 'bank_transfer', 'mobile_money'][array_rand([0, 1, 2])],
                    'payment_status' => ['paid', 'pending'][array_rand([0, 1])],
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                ]);
            }
        }
    }
}