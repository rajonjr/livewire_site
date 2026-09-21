<div class="min-h-[80vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl w-full bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100 grid grid-cols-1 md:grid-cols-2">
        
        <!-- Formulaire -->
        <div class="p-8 sm:p-12 flex flex-col justify-center">
            
            <div class="text-center md:text-left mb-8">
                <h2 class="text-2xl font-bold text-gray-900">Nouveau mot de passe</h2>
                <p class="text-sm text-gray-500 mt-1">Veuillez entrer votre nouveau mot de passe ci-dessous.</p>
            </div>

            <!-- Messages de notification ou d'erreur -->
            @if (session()->has('status'))
                <div class="mb-6 bg-green-50 text-green-700 p-4 rounded-xl text-sm border border-green-200">
                    {{ session('status') }}
                </div>
            @endif

            <form wire:submit.prevent="resetPassword">
                
                <!-- Jeton (Token) caché -->
                <input type="hidden" wire:model="token">

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Adresse e-mail</label>
                    <input type="email" id="email" wire:model="email" required readonly
                           class="w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-xl text-gray-500 cursor-not-allowed">
                    @error('email') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Nouveau mot de passe -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Nouveau mot de passe</label>
                    <input type="password" id="password" wire:model="password" required autofocus
                           class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500">
                    @error('password') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Confirmation du mot de passe -->
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirmer le mot de passe</label>
                    <input type="password" id="password_confirmation" wire:model="password_confirmation" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!-- Bouton de soumission -->
                <button type="submit" class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-xl transition shadow-sm">
                    <span wire:loading.remove>Réinitialiser le mot de passe</span>
                    <span wire:loading>Réinitialisation en cours...</span>
                </button>

            </form>
        </div>

        <!-- Panneau Visuel adaptatif -->
        <div class="hidden md:flex relative bg-indigo-900 items-center justify-center p-12 overflow-hidden">
            <!-- Image de fond-->
            <div class="absolute inset-0 bg-cover bg-center opacity-30 mix-blend-overlay" style="background-image: url('https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&q=80&w=1000');"></div>
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-900/90 to-indigo-800/85"></div>

            <!-- Contenu textuel adapté -->
            <div class="relative z-10 text-white text-center max-w-sm">
                <span class="inline-block px-3 py-1 bg-white/10 text-indigo-200 backdrop-blur-sm rounded-full text-xs font-semibold tracking-wider uppercase mb-4">
                    Sécurité du Compte
                </span>
                <h3 class="text-2xl font-bold mb-3">Protégez votre espace de travail</h3>
                <p class="text-indigo-200 text-sm leading-relaxed">
                    Choisissez un mot de passe sécurisé pour retrouver un accès serein à vos réservations, vos factures et votre espace professionnel.
                </p>
            </div>
        </div>

    </div>
</div>