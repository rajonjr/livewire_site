<div class="min-h-[80vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl w-full bg-white rounded-2xl shadow-xl overflow-hidden grid grid-cols-1 md:grid-cols-2 border border-gray-100">

        <!-- Formulaire de Confirmation -->
        <div class="p-8 sm:p-12 flex flex-col justify-center">
            <div class="text-center md:text-left mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Zone sécurisée</h2>
                <p class="text-sm text-gray-500 mt-1">Veuillez confirmer votre mot de passe avant de continuer.</p>
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
            <form wire:submit.prevent="confirm">
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
                    <input type="password" wire:model="password" required autofocus placeholder="" class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    @error('password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="w-full bg-indigo-600 text-white py-2.5 rounded-lg font-medium hover:bg-indigo-700 transition shadow-md flex items-center justify-center">
                    <span wire:loading.remove>Confirmer</span>
                    <span wire:loading>Confirmation en cours...</span>
                </button>
            </form>
        </div>

        <!-- Panneau Visuel -->
        <div class="hidden md:flex relative bg-indigo-900 items-center justify-center p-12 overflow-hidden">
            <!-- Image de fond -->
            <div class="absolute inset-0 bg-cover bg-center opacity-30 mix-blend-overlay" style="background-image: url('https://images.unsplash.com/photo-1555421689-491a97ff2040?auto=format&fit=crop&q=80&w=1000');"></div>
            <div class="absolute inset-0 bg-linear-to-br from-indigo-900/90 to-indigo-800/85"></div>

            <!-- Contenu textuel par-dessus l'image -->
            <div class="relative z-10 text-white text-center max-w-sm">
                <span class="inline-block px-3 py-1 bg-white/10 text-indigo-200 backdrop-blur-sm rounded-full text-xs font-semibold tracking-wider uppercase mb-4">
                    Sécurité Renforcée
                </span>
                <h3 class="text-2xl font-bold mb-3">Vérification de sécurité</h3>
                <p class="text-indigo-200 text-sm leading-relaxed">
                    Cette zone sensible de l'application requiert une vérification rapide de votre identité pour protéger vos données personnelles et vos réservations.
                </p>
            </div>
        </div>

    </div>
</div>
