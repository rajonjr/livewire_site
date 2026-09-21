<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Espace Réservation' }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @livewireStyles
    </head>
    <body class="bg-gray-50 flex flex-col min-h-screen text-gray-800">

        <!-- Navigation Globale -->
        <header class="bg-white shadow-sm sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
                <div class="flex items-center space-x-6">
                    <a href="{{ url('/') }}" class="font-bold text-xl text-indigo-600 tracking-wide">
                        Coworking<span class="text-gray-900">Space</span>
                    </a>

                    @auth
                        <nav class="hidden md:flex space-x-4 text-sm font-medium">
                            <a href="{{ url('/booking') }}" class="{{ request()->is('booking*') ? 'text-indigo-600 font-semibold' : 'text-gray-600 hover:text-indigo-600' }} transition">Réservations</a>
                            <a href="{{ url('/billing') }}" class="{{ request()->is('billing*') ? 'text-indigo-600 font-semibold' : 'text-gray-600 hover:text-indigo-600' }} transition">Abonnement & Factures</a>
                        </nav>
                    @endauth
                </div>

                <div class="flex items-center space-x-4">
                    @auth
                        <span class="text-sm font-medium text-gray-700 hidden sm:inline">Bonjour, {{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-sm font-medium text-red-600 hover:underline">Déconnexion</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-indigo-600 transition">Connexion</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition shadow-sm">S'inscrire</a>
                    @endauth
                </div>
            </div>
        </header>

        <!-- Contenu Principal (Slot Livewire) -->
        <main class="grow max-w-7xl w-full mx-auto px-6 py-8">
            {{ $slot }}
        </main>

        <!-- Footer Global -->
        <footer class="bg-white border-t border-gray-200 mt-auto text-gray-600">
            <div class="max-w-7xl mx-auto px-6 py-12 grid grid-cols-1 md:grid-cols-4 gap-8">

                <!-- Colonne 1 : À propos -->
                <div class="space-y-4">
                    <span class="font-bold text-xl text-indigo-600 tracking-wide">
                        Coworking<span class="text-gray-900">Space</span>
                    </span>
                    <p class="text-sm text-gray-500">
                        La solution moderne et flexible pour réserver vos bureaux, open-spaces et salles de réunion en toute simplicité.
                    </p>
                    <div class="flex space-x-4 text-gray-400">
                        <!-- Icônes Réseaux Sociaux (SVG) -->
                        <a href="#" class="hover:text-indigo-600 transition" aria-label="Facebook">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                        </a>
                        <a href="#" class="hover:text-indigo-600 transition" aria-label="Twitter">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/></svg>
                        </a>
                        <a href="#" class="hover:text-indigo-600 transition" aria-label="LinkedIn">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6zM2 9h4v12H2zM4 2a2 2 0 1 1-2 2 2 2 0 0 1 2-2z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Colonne 2 : Navigation Rapide -->
                <div>
                    <h4 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-4">Navigation</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ url('/') }}" class="hover:text-indigo-600 transition">Accueil</a></li>
                        <li><a href="{{ url('/booking') }}" class="hover:text-indigo-600 transition">Espace de Réservation</a></li>
                        <li><a href="{{ url('/billing') }}" class="hover:text-indigo-600 transition">Abonnements & Factures</a></li>
                    </ul>
                </div>

                <!-- Colonne 3 : Légal & Support -->
                <div>
                    <h4 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-4">Support & Légal</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-indigo-600 transition">Centre d'aide / FAQ</a></li>
                        <li><a href="#" class="hover:text-indigo-600 transition">Mentions légales</a></li>
                        <li><a href="#" class="hover:text-indigo-600 transition">Politique de confidentialité</a></li>
                        <li><a href="#" class="hover:text-indigo-600 transition">Conditions Générales de Vente</a></li>
                    </ul>
                </div>

                <!-- Colonne 4 : Newsletter / Contact Rapide -->
                <div>
                    <h4 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-4">Restez informé</h4>
                    <p class="text-sm text-gray-500 mb-3">Recevez nos actualités et offres exclusives directement par email.</p>
                    <form onsubmit="event.preventDefault();" class="flex flex-col space-y-2">
                        <input type="email" placeholder="votre@email.com" class="px-3 py-2 text-sm bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition shadow-sm">
                            S'inscrire
                        </button>
                    </form>
                </div>

            </div>

            <!-- Copyright du Bas -->
            <div class="border-t border-gray-100 py-6">
                <div class="max-w-7xl mx-auto px-6 flex flex-col sm:flex-row justify-between items-center text-xs text-gray-400">
                    <p>&copy; {{ date('Y') }} CoworkingSpace. Propulsé par Laravel & Livewire. Tous droits réservés.</p>
                    <div class="flex space-x-6 mt-4 sm:mt-0">
                        <span>Développé avec ❤️ pour les professionnels</span>
                    </div>
                </div>
            </div>
        </footer>

        @livewireScripts
    </body>
</html>
