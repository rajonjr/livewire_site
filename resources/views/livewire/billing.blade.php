<div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8" x-data="{ billingCycle: 'monthly' }">

    <!-- En-tête de la page -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Abonnement & Facturation</h1>
        <p class="text-sm text-gray-500 mt-1">Gérez votre formule, vos informations de paiement et consultez vos factures passées.</p>
    </div>

    <!-- Messages de notification (Flash) -->
    @if (session()->has('success'))
        <div class="mb-6 bg-green-50 text-green-700 p-4 rounded-xl text-sm border border-green-200 flex items-center shadow-sm">
            <svg class="w-5 h-5 text-green-500 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="mb-6 bg-red-50 text-red-700 p-4 rounded-xl text-sm border border-red-200 flex items-center shadow-sm">
            <svg class="w-5 h-5 text-red-500 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            {{ session('error') }}
        </div>
    @endif

    <!-- SECTION 1 : Plan Actuel -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8 mb-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 pb-6 border-b border-gray-100">
            <div>
                <span class="inline-flex items-center px-3 py-1 bg-indigo-50 text-indigo-700 text-xs font-semibold rounded-full border border-indigo-200 mb-3">
                    Plan Actuel
                </span>
                <h2 class="text-2xl font-bold text-gray-900">
                    @if($subscription && $subscription->active())
                        Formule Active ({{ ucfirst($subscription->stripe_price) }})
                    @else
                        Aucun abonnement actif
                    @endif
                </h2>
                @if($subscription && $subscription->onGracePeriod())
                    <p class="text-sm text-amber-600 mt-1">Votre abonnement prendra fin le <span class="font-medium">{{ $subscription->ends_at->format('d/m/Y') }}</span>.</p>
                @elseif($subscription)
                    <p class="text-sm text-gray-500 mt-1">Renouvellement automatique prévu.</p>
                @endif
            </div>
            @if($subscription && !$subscription->onGracePeriod())
                <div class="flex items-center gap-3">
                    <button wire:click="cancelSubscription" wire:confirm="Êtes-vous sûr de vouloir résilier votre abonnement ?" class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition shadow-sm">
                        Résilier le plan
                    </button>
                </div>
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-6">
            <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold mb-1">Statut</p>
                <p class="text-sm font-bold text-green-600 flex items-center">
                    <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                    {{ $subscription && $subscription->active() ? 'Actif' : 'Inactif' }}
                </p>
            </div>
            <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold mb-1">Mode de facturation</p>
                <p class="text-sm font-bold text-gray-900">Stripe Sécurisé</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold mb-1">Portail client</p>
                <p class="text-sm font-bold text-indigo-600">Géré via Stripe</p>
            </div>
        </div>
    </div>

    <!-- SECTION 2 : Changement de Formule (Pricing) -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8 mb-8">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-8 pb-4 border-b border-gray-100">
            <div>
                <h3 class="text-lg font-bold text-gray-900">Changer de formule</h3>
                <p class="text-sm text-gray-500">Choisissez le plan qui correspond le mieux à vos besoins actuels.</p>
            </div>
            <!-- Sélecteur Mensuel / Annuel -->
            <div class="bg-gray-100 p-1 rounded-xl flex items-center space-x-1 border border-gray-200">
                <button @click="billingCycle = 'monthly'" :class="{ 'bg-white text-gray-900 shadow-sm': billingCycle === 'monthly', 'text-gray-500 hover:text-gray-900': billingCycle !== 'monthly' }" class="px-4 py-1.5 rounded-lg text-xs font-semibold transition">
                    Mensuel
                </button>
                <button @click="billingCycle = 'annual'" :class="{ 'bg-white text-gray-900 shadow-sm': billingCycle === 'annual', 'text-gray-500 hover:text-gray-900': billingCycle !== 'annual' }" class="px-4 py-1.5 rounded-lg text-xs font-semibold transition flex items-center">
                    Annuel <span class="ml-1.5 text-[10px] bg-green-100 text-green-700 px-1.5 py-0.5 rounded-full font-bold">-20%</span>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Plan Starter -->
            <div class="border border-gray-200 rounded-2xl p-6 flex flex-col justify-between hover:border-indigo-300 transition">
                <div>
                    <h4 class="font-bold text-gray-900 text-base mb-1">Starter</h4>
                    <p class="text-xs text-gray-500 mb-4">Idéal pour démarrer.</p>
                    <div class="text-3xl font-extrabold text-gray-900 mb-6">
                        <span x-text="billingCycle === 'monthly' ? '9 €' : '7 €'"></span>
                        <span class="text-xs font-normal text-gray-500">/ mois</span>
                    </div>
                </div>
                <button @click="$wire.switchPlan('starter', billingCycle)" class="w-full py-2.5 border border-gray-300 text-gray-700 rounded-xl text-sm font-medium hover:bg-gray-50 transition">
                    Passer au Starter
                </button>
            </div>

            <!-- Plan Enterprise -->
            <div class="border border-gray-200 rounded-2xl p-6 flex flex-col justify-between hover:border-indigo-300 transition">
                <div>
                    <h4 class="font-bold text-gray-900 text-base mb-1">Enterprise</h4>
                    <p class="text-xs text-gray-500 mb-4">Pour les structures exigeantes.</p>
                    <div class="text-3xl font-extrabold text-gray-900 mb-6">
                        <span x-text="billingCycle === 'monthly' ? '99 €' : '79 €'"></span>
                        <span class="text-xs font-normal text-gray-500">/ mois</span>
                    </div>
                </div>
                <button @click="$wire.switchPlan('enterprise', billingCycle)" class="w-full py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-medium transition shadow-sm">
                    Passer à Enterprise
                </button>
            </div>
        </div>
    </div>

    <!-- SECTION 3 : Mode de Paiement & Historique des Factures -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- Moyen de paiement -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Moyen de paiement</h3>

            @if($paymentMethod)
                <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-6 bg-indigo-900 text-white rounded font-bold text-[10px] flex items-center justify-center tracking-tighter uppercase">
                            {{ $paymentMethod->card->brand }}
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-800">•••• •••• •••• {{ $paymentMethod->card->last4 }}</p>
                            <p class="text-xs text-gray-500">Expire le {{ $paymentMethod->card->exp_month }}/{{ $paymentMethod->card->exp_year }}</p>
                        </div>
                    </div>
                    <span class="text-xs bg-green-100 text-green-700 font-semibold px-2 py-0.5 rounded">Principal</span>
                </div>
            @else
                <p class="text-sm text-gray-500 mb-4">Aucune carte enregistrée.</p>
            @endif

            <button wire:click="updatePaymentMethod" class="w-full py-2.5 border border-gray-300 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-50 transition shadow-sm">
                Gérer mes cartes (Stripe)
            </button>
        </div>

        <!-- Historique des factures -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8 lg:col-span-2">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Historique des factures</h3>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                            <th class="pb-3">Date</th>
                            <th class="pb-3">Montant</th>
                            <th class="pb-3">Statut</th>
                            <th class="pb-3 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        @forelse ($invoices as $invoice)
                            <tr>
                                <td class="py-3 text-gray-800 font-medium">{{ $invoice->date()->toFormattedDateString() }}</td>
                                <td class="py-3 text-gray-600">{{ $invoice->rawTotal() ? $invoice->total() : '0,00 €' }}</td>
                                <td class="py-3"><span class="px-2.5 py-1 bg-green-50 text-green-700 text-xs font-semibold rounded-full border border-green-200">Payée</span></td>
                                <td class="py-3 text-right">
                                    <button wire:click="downloadInvoice('{{ $invoice->id }}')" class="text-indigo-600 font-medium hover:underline text-xs">PDF</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-4 text-center text-sm text-gray-500">Aucune facture disponible pour le moment.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>
