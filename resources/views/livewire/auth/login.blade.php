<div class="min-h-[80vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl w-full bg-white rounded-2xl shadow-xl overflow-hidden grid grid-cols-1 md:grid-cols-2 border border-gray-100">

        <!--Formulaire & Réseaux Sociaux -->
        <div class="p-8 sm:p-12 flex flex-col justify-center">
            <div class="text-center md:text-left mb-8">
                <h2 class="text-2xl font-bold text-gray-900">Connexion</h2>
                <p class="text-sm text-gray-500 mt-1">Connectez-vous pour accéder à votre espace.</p>
            </div>

            <!-- Messages d'état / erreurs -->
            @if (session('status'))
                <div class="mb-4 bg-green-50 text-green-700 p-3 rounded-lg text-sm border border-green-200">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 bg-red-50 text-red-700 p-3 rounded-lg text-sm border border-red-200">
                    <ul class="list-disc pl-4 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Boutons de Connexion Sociale -->
            <div class="grid grid-cols-2 gap-3 mb-6">
                <!-- Google -->
                <a href="#" class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition shadow-sm">
                    <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/>
                        <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.19v3.15C3.17 21.36 7.23 24 12 24z"/>
                        <path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.19C.43 8.1 0 9.8 0 12s.43 3.9 1.19 5.42l4.09-3.15z"/>
                        <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.23 0 3.17 2.64 1.19 6.58l4.09 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/>
                    </svg>
                    Google
                </a>
                <!-- LinkedIn -->
                <a href="#" class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition shadow-sm">
                    <svg class="w-4 h-4 mr-2 fill-current text-[#0A66C2]" viewBox="0 0 24 24">
                        <path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.46 10.9v8.37H9.2v-8.37H6.46M7.83 6.5a1.5 1.5 0 1 0 1.5 1.5 1.5 1.5 0 0 0-1.5-1.5z"/>
                    </svg>
                    LinkedIn
                </a>
            </div>

            <div class="relative flex py-2 items-center mb-6">
                <div class="grow border-t border-gray-200"></div>
                <span class="shrink mx-4 text-gray-400 text-xs uppercase tracking-wider">Ou avec email</span>
                <div class="grow border-t border-gray-200"></div>
            </div>

            <!-- Formulaire Standard -->
            <form wire:submit.prevent="login">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" wire:model="email" required autofocus placeholder="votre@email.com" class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    @error('email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
                    <input type="password" wire:model="password" required placeholder="" class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    @error('password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div class="flex items-center justify-between mb-6 text-sm">
                    <label class="flex items-center">
                        <input type="checkbox" wire:model="remember" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                        <span class="ml-2 text-gray-600">Se souvenir de moi</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-indigo-600 hover:underline font-medium">Mot de passe oublié ?</a>
                    @endif
                </div>

                <button type="submit" class="w-full bg-indigo-600 text-white py-2.5 rounded-lg font-medium hover:bg-indigo-700 transition shadow-md flex items-center justify-center">
                    <span wire:loading.remove>Se connecter</span>
                    <span wire:loading>Connexion en cours...</span>
                </button>
            </form>

            <p class="mt-6 text-center text-sm text-gray-600">
                Pas encore de compte ? <a href="{{ route('register') }}" class="text-indigo-600 font-semibold hover:underline">S'inscrire</a>
            </p>
        </div>

        <!-- Panneau Visuel -->
        <div class="hidden md:flex relative bg-indigo-900 items-center justify-center p-12 overflow-hidden">
            <!-- Image de fond / Overlay dégradé -->
            <div class="absolute inset-0 bg-cover bg-center opacity-30 mix-blend-overlay" style="background-image: url('https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&q=80&w=1000');"></div>
            <div class="absolute inset-0 bg-linear-to-br from-indigo-900/90 to-indigo-800/85"></div>

            <!-- Contenu textuel par-dessus l'image -->
            <div class="relative z-10 text-white text-center max-w-sm">
                <span class="inline-block px-3 py-1 bg-white/10 text-indigo-200 backdrop-blur-sm rounded-full text-xs font-semibold tracking-wider uppercase mb-4">
                    Espace Coworking
                </span>
                <h3 class="text-2xl font-bold mb-3">Rejoignez une communauté dynamique</h3>
                <p class="text-indigo-200 text-sm leading-relaxed">
                    Accédez instantanément à vos réservations, gérez vos abonnements en toute simplicité et profitez d'un cadre de travail unique.
                </p>
            </div>
        </div>

    </div>
</div>
