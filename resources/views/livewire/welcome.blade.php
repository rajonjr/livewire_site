<div class="flex flex-col items-center text-center">

    <!-- SECTION HERO -->
    <div class="flex flex-col items-center text-center py-12 max-w-4xl mx-auto">
        <div class="inline-block mb-4 px-3 py-1 bg-indigo-50 text-indigo-600 rounded-full text-xs font-semibold tracking-wide uppercase">
            Plateforme de Gestion & Réservation de Coworking
        </div>

        <h1 class="text-4xl sm:text-6xl font-extrabold text-gray-900 tracking-tight mb-6">
            Trouvez l'espace de travail idéal pour booster votre productivité
        </h1>

        <p class="text-lg text-gray-600 mb-8 max-w-2xl">
            Réservez vos bureaux privés, postes en open-space ou salles de réunion en quelques clics grâce à notre application moderne et sécurisée.
        </p>

        @if (session()->has('error'))
            <div class="mb-6 bg-red-50 text-red-700 p-4 rounded-xl text-sm border border-red-200">
                {{ session('error') }}
            </div>
        @endif

        <div class="flex flex-col sm:flex-row gap-4">
            @auth
                <a href="{{ url('/booking') }}" class="px-8 py-3 bg-indigo-600 text-white font-medium rounded-lg shadow hover:bg-indigo-700 transition">
                    Accéder à mon tableau de bord
                </a>
            @else
                <a href="{{ route('register') }}" class="px-8 py-3 bg-indigo-600 text-white font-medium rounded-lg shadow hover:bg-indigo-700 transition">
                    Commencer dès maintenant
                </a>
                <a href="{{ route('login') }}" class="px-8 py-3 bg-white border border-gray-300 text-gray-700 font-medium rounded-lg shadow-sm hover:bg-gray-50 transition">
                    Se connecter
                </a>
            @endauth
        </div>
    </div>

    <!-- SECTION TYPES D'ESPACES -->
    <div class="w-full max-w-7xl mx-auto py-16 border-t border-gray-200">
        <div class="text-center mb-12">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Nos Espaces de Travail</h2>
            <p class="text-gray-600 mt-2">Des solutions flexibles adaptées à chaque besoin professionnel.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 px-4">
            <!-- Open Space -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden text-left flex flex-col justify-between">
                <div class="p-6">
                    <span class="inline-block px-2.5 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded mb-4">Populaire</span>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Open Space Partagé</h3>
                    <p class="text-sm text-gray-600 mb-4">Un poste de travail nomade dans un espace lumineux, idéal pour les freelances et créateurs.</p>
                    <ul class="text-sm text-gray-500 space-y-2 mb-6">
                        <li>✔️ Wi-Fi haut débit inclus</li>
                        <li>✔️ Accès illimité aux espaces détente</li>
                        <li>✔️ Café & thé à volonté</li>
                    </ul>
                </div>
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-between items-center">
                    <span class="font-bold text-gray-900">À partir de 15€ / jour</span>
                    <button wire:click="bookSpace('openspace')" class="text-sm font-semibold text-indigo-600 hover:underline">Réserver &rarr;</button>
                </div>
            </div>

            <!-- Bureau Privé -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden text-left flex flex-col justify-between">
                <div class="p-6">
                    <span class="inline-block px-2.5 py-1 bg-indigo-100 text-indigo-700 text-xs font-semibold rounded mb-4">Équipe & Résident</span>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Bureau Privé Fermé</h3>
                    <p class="text-sm text-gray-600 mb-4">Un bureau sécurisé et calme pour les équipes de 2 à 10 collaborateurs.</p>
                    <ul class="text-sm text-gray-500 space-y-2 mb-6">
                        <li>✔️ Mobilier ergonomique fourni</li>
                        <li>✔️ Accès 24h/7j</li>
                        <li>✔️ Clé / Badge privatif</li>
                    </ul>
                </div>
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-between items-center">
                    <span class="font-bold text-gray-900">Sur abonnement mensuel</span>
                    <a href="{{ url('/billing') }}" class="text-sm font-semibold text-indigo-600 hover:underline">Voir les abonnements &rarr;</a>
                </div>
            </div>

            <!-- Salle de réunion -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden text-left flex flex-col justify-between">
                <div class="p-6">
                    <span class="inline-block px-2.5 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded mb-4">Événement & Pro</span>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Salle de Réunion</h3>
                    <p class="text-sm text-gray-600 mb-4">Un espace équipé pour vos présentations, séminaires ou entretiens professionnels.</p>
                    <ul class="text-sm text-gray-500 space-y-2 mb-6">
                        <li>✔️ Écran géant & Visioconférence</li>
                        <li>✔️ Tableau blanc interactif</li>
                        <li>✔️ Capacité jusqu'à 12 personnes</li>
                    </ul>
                </div>
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-between items-center">
                    <span class="font-bold text-gray-900">À partir de 30€ / heure</span>
                    <button wire:click="bookSpace('meeting')" class="text-sm font-semibold text-indigo-600 hover:underline">Réserver &rarr;</button>
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION FONCTIONNALITÉS TECHNIQUES (GRID) -->
    <div class="w-full max-w-7xl mx-auto py-16 border-t border-gray-200">
        <div class="text-center mb-12">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Pourquoi Choisir Notre Plateforme ?</h2>
            <p class="text-gray-600 mt-2">Conçu avec les technologies les plus modernes pour une expérience fluide.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 px-4 text-left">
            <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-100">
                <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-lg flex items-center justify-center font-bold mb-4">01</div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Réservation en Temps Réel</h3>
                <p class="text-sm text-gray-600">Disponibilités instantanées et gestion simplifiée de vos créneaux grâce à une interface Livewire ultra-réactive.</p>
            </div>
            <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-100">
                <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-lg flex items-center justify-center font-bold mb-4">02</div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Abonnements & Facturation</h3>
                <p class="text-sm text-gray-600">Suivi clair de vos abonnements mensuels, états des paiements et téléchargement rapide de vos factures.</p>
            </div>
            <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-100">
                <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-lg flex items-center justify-center font-bold mb-4">03</div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Sécurité Renforcée</h3>
                <p class="text-sm text-gray-600">Protection des comptes avec authentification à double facteur (2FA) et validation des actions sensibles.</p>
            </div>
        </div>
    </div>

    <!-- BANNIÈRE D'APPEL À L'ACTION (CTA) -->
    <div class="w-full bg-indigo-900 text-white py-16 px-6 mt-8 rounded-2xl max-w-7xl mx-auto mb-8 flex flex-col items-center text-center">
        <h2 class="text-3xl font-extrabold mb-4">Prêt à transformer votre façon de travailler ?</h2>
        <p class="text-indigo-200 mb-8 max-w-xl text-sm sm:text-base">
            Rejoignez notre communauté de professionnels dès aujourd'hui et réservez votre premier espace en quelques clics.
        </p>
        @auth
            <a href="{{ url('/booking') }}" class="px-8 py-3 bg-white text-indigo-900 font-bold rounded-lg shadow hover:bg-indigo-50 transition">
                Accéder à l'espace de réservation
            </a>
        @else
            <a href="{{ route('register') }}" class="px-8 py-3 bg-white text-indigo-900 font-bold rounded-lg shadow hover:bg-indigo-50 transition">
                Créer un compte gratuit
            </a>
        @endauth
    </div>

</div>
