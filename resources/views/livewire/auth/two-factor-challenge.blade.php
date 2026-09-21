<div class="min-h-[80vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8" x-data="{ recovery: false }">
    <div class="max-w-4xl w-full bg-white rounded-2xl shadow-xl overflow-hidden grid grid-cols-1 md:grid-cols-2 border border-gray-100">

        <!-- Formulaire 2FA -->
        <div class="p-8 sm:p-12 flex flex-col justify-center">
            <div class="text-center md:text-left mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Sécurité 2FA</h2>
                <p class="text-sm text-gray-500 mt-1" x-show="!recovery">
                    Veuillez entrer le code d'authentification fourni par votre application.
                </p>
                <p class="text-sm text-gray-500 mt-1" x-show="recovery" style="display: none;">
                    Veuillez entrer l'un de vos codes de secours d'urgence.
                </p>
            </div>

            <!-- Messages d'erreurs -->
            @if ($errors->any())
                <div class="mb-4 bg-red-50 text-red-700 p-3 rounded-lg text-sm border border-red-200">
                    <ul class="list-disc pl-4 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Formulaire -->
            <form wire:submit.prevent="login">
                <!-- Champ Code d'authentification -->
                <div class="mb-4" x-show="!recovery">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Code d'authentification</label>
                    <input type="text" wire:model="code" autofocus autocomplete="one-time-code" placeholder="123456" class="w-full border border-gray-300 rounded-lg p-2.5 text-sm shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 tracking-widest text-center font-semibold">
                </div>

                <!-- Champ Code de secours -->
                <div class="mb-4" x-show="recovery" style="display: none;">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Code de secours</label>
                    <input type="text" wire:model="recovery_code" autocomplete="one-time-code" placeholder="xxxx-xxxx" class="w-full border border-gray-300 rounded-lg p-2.5 text-sm shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 tracking-wider text-center font-mono">
                </div>

                <!-- Bouton Bascule Code / Secours -->
                <div class="flex items-center justify-end mb-6 text-sm">
                    <button type="button" class="text-indigo-600 hover:underline font-medium cursor-pointer" x-on:click="recovery = ! recovery; $wire.code = ''; $wire.recovery_code = ''">
                        <span x-show="!recovery">Utiliser un code de secours</span>
                        <span x-show="recovery" style="display: none;">Utiliser l'application d'authentification</span>
                    </button>
                </div>

                <button type="submit" class="w-full bg-indigo-600 text-white py-2.5 rounded-lg font-medium hover:bg-indigo-700 transition shadow-md flex items-center justify-center">
                    <span wire:loading.remove>Valider</span>
                    <span wire:loading>Validation en cours...</span>
                </button>
            </form>
        </div>

        <!-- Panneau Visuel -->
        <div class="hidden md:flex relative bg-indigo-900 items-center justify-center p-12 overflow-hidden">
            <!-- Image de fond -->
            <div class="absolute inset-0 bg-cover bg-center opacity-30 mix-blend-overlay" style="background-image: url('https://images.unsplash.com/photo-1563986768609-322da13575f3?auto=format&fit=crop&q=80&w=1000');"></div>
            <div class="absolute inset-0 bg-linear-to-br from-indigo-900/90 to-indigo-800/85"></div>

            <!-- Contenu textuel par-dessus l'image -->
            <div class="relative z-10 text-white text-center max-w-sm">
                <span class="inline-block px-3 py-1 bg-white/10 text-indigo-200 backdrop-blur-sm rounded-full text-xs font-semibold tracking-wider uppercase mb-4">
                    Protection Maximale
                </span>
                <h3 class="text-2xl font-bold mb-3">Authentification à deux facteurs</h3>
                <p class="text-indigo-200 text-sm leading-relaxed">
                    Votre compte est protégé par une couche de sécurité supplémentaire. Entrez le code à usage unique généré par votre application pour accéder à vos espaces.
                </p>
            </div>
        </div>

    </div>
</div>
