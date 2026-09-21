<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Billing extends Component
{
    /**
     * Redirige l'utilisateur vers Stripe Checkout pour s'abonner au plan choisi.
     */
    public function switchPlan($planName, $billingCycle = 'monthly')
    {
        $user = Auth::user();

        // Exemple de mapping des ID de prix Stripe (à configurer dans vos .env ou config)
        // Remplacez ces identifiants par vos réels Price IDs Stripe
        $prices = [
            'starter' => [
                'monthly' => 'price_starter_monthly_xxx',
                'annual' => 'price_starter_annual_xxx',
            ],
            'enterprise' => [
                'monthly' => 'price_enterprise_monthly_xxx',
                'annual' => 'price_enterprise_annual_xxx',
            ],
        ];

        $priceId = $prices[$planName][$billingCycle] ?? null;

        if (!$priceId) {
            session()->flash('error', 'Formule invalide.');
            return;
        }

        // Si l'utilisateur a déjà un abonnement actif, on gère la mise à niveau/changement
        if ($user->subscribed('default')) {
            try {
                $user->subscription('default')->swap($priceId);
                session()->flash('success', "Votre formule a été mise à jour avec succès.");
                return;
            } catch (\Exception $e) {
                session()->flash('error', "Erreur lors de la mise à jour : " . $e->getMessage());
                return;
            }
        }

        // Sinon, on initie un nouvel abonnement via Stripe Checkout
        return $user->newSubscription('default', $priceId)
            ->checkout([
                'success_url' => route('billing') . '?success=true',
                'cancel_url' => route('billing') . '?cancel=true',
            ]);
    }

    /**
     * Résilie l'abonnement de l'utilisateur à la fin de la période en cours.
     */
    public function cancelSubscription()
    {
        $user = Auth::user();

        if ($user->subscribed('default')) {
            $user->subscription('default')->cancel();
            session()->flash('success', "Votre abonnement a bien été résilié (il restera actif jusqu'à la fin de la période en cours).");
        } else {
            session()->flash('error', "Aucun abonnement actif trouvé.");
        }
    }

    /**
     * Redirige vers le portail de facturation Stripe pour modifier la carte bancaire.
     */
    public function updatePaymentMethod()
    {
        $user = Auth::user();

        if (!$user->hasStripeId()) {
            return redirect()->route('billing')->with('error', "Aucun compte de paiement associé.");
        }

        return $user->redirectToBillingPortal(route('billing'));
    }

    /**
     * Télécharge une facture spécifique via l'ID de facture Stripe.
     */
    public function downloadInvoice($invoiceId)
    {
        $user = Auth::user();

        try {
            return $user->downloadInvoice($invoiceId, [
                'vendor' => config('app.name'),
                'product' => 'Abonnement SaaS',
            ]);
        } catch (\Exception $e) {
            session()->flash('error', "Impossible de télécharger la facture.");
        }
    }

    public function render()
    {
        $user = Auth::user();
        $subscription = $user->subscription('default');

        return view('livewire.billing', [
            'subscription' => $subscription,
            'invoices' => $user->hasStripeId() ? $user->invoices() : [],
            'paymentMethod' => $user->hasStripeId() ? $user->defaultPaymentMethod() : null,
        ])->layout('layouts.app');
    }
}
