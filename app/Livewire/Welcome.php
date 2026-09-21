<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Welcome extends Component
{
    public function bookSpace($type)
    {
        // Vérifier si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Définir les tarifs et descriptions selon l'espace choisi
        $spaces = [
            'openspace' => [
                'name' => 'Open Space Partagé (1 Jour)',
                'amount' => 1500, // en centimes (15,00 €)
            ],
            'meeting' => [
                'name' => 'Salle de Réunion (1 Heure)',
                'amount' => 3000, // en centimes (30,00 €)
            ],
        ];

        if (!array_key_exists($type, $spaces)) {
            session()->flash('error', 'Espace de travail invalide.');
            return;
        }

        $space = $spaces[$type];

        try {
            // Redirection vers Stripe Checkout (Paiement unique)
            return $user->checkout([
                [
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => [
                            'name' => $space['name'],
                            'description' => 'Réservation instantanée via la plateforme',
                        ],
                        'unit_amount' => $space['amount'],
                    ],
                    'quantity' => 1,
                ]
            ], [
                'success_url' => route('booking.success') . '?session_id={CHECKOUT_SESSION_ID}&type=' . $type,
                'cancel_url' => route('welcome') . '?cancel=true',
            ]);

        } catch (\Exception $e) {
            session()->flash('error', 'Erreur de paiement : ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.welcome')->layout('layouts.app');
    }
}
