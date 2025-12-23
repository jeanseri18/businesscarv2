<?php

namespace Database\Seeders;

use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PaiementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer toutes les souscriptions
        $subscriptions = Subscription::all();

        foreach ($subscriptions as $subscription) {
            // Créer des paiements selon le statut de paiement de la souscription
            if ($subscription->payment_status === 'paid') {
                // Créer un paiement réussi
                Payment::create([
                    'subscription_id' => $subscription->id,
                    'amount' => $subscription->price,
                    'currency' => 'XOF',
                    'payment_method' => $subscription->payment_method,
                    'transaction_id' => 'TXN' . str_pad($subscription->id, 6, '0', STR_PAD_LEFT) . rand(1000, 9999),
                    'status' => 'completed',
                    'paid_at' => Carbon::now()->subDays(rand(1, 30)),
                ]);
            } elseif ($subscription->payment_status === 'pending') {
                // Créer un paiement en attente
                Payment::create([
                    'subscription_id' => $subscription->id,
                    'amount' => $subscription->price,
                    'currency' => 'XOF',
                    'payment_method' => $subscription->payment_method,
                    'transaction_id' => 'TXN' . str_pad($subscription->id, 6, '0', STR_PAD_LEFT) . rand(1000, 9999),
                    'status' => 'pending',
                    'paid_at' => null,
                ]);
            } elseif ($subscription->payment_status === 'failed') {
                // Créer un paiement échoué
                Payment::create([
                    'subscription_id' => $subscription->id,
                    'amount' => $subscription->price,
                    'currency' => 'XOF',
                    'payment_method' => $subscription->payment_method,
                    'transaction_id' => 'TXN' . str_pad($subscription->id, 6, '0', STR_PAD_LEFT) . rand(1000, 9999),
                    'status' => 'failed',
                    'paid_at' => null,
                ]);
            }

            // Créer quelques paiements supplémentaires avec différents statuts
            if (rand(1, 3) === 1) {
                $statuses = ['completed', 'pending', 'failed', 'refunded'];
                $status = $statuses[array_rand($statuses)];
                
                Payment::create([
                    'subscription_id' => $subscription->id,
                    'amount' => $subscription->price * 0.1, // 10% du montant original
                    'currency' => 'XOF',
                    'payment_method' => ['credit_card', 'bank_transfer', 'mobile_money', 'paypal'][array_rand([0, 1, 2, 3])],
                    'transaction_id' => 'TXN' . str_pad($subscription->id + 1000, 6, '0', STR_PAD_LEFT) . rand(1000, 9999),
                    'status' => $status,
                    'paid_at' => $status === 'completed' ? Carbon::now()->subDays(rand(1, 60)) : null,
                ]);
            }
        }
    }
}