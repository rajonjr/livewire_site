<div class="min-h-[80vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl w-full bg-white rounded-2xl shadow-xl overflow-hidden grid grid-cols-1 md:grid-cols-2 border border-gray-100">

        <!-- Actions de Vérification -->
        <div class="p-8 sm:p-12 flex flex-col justify-center">
            <div class="text-center md:text-left mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Vérifiez votre e-mail</h2>
                <p class="text-sm text-gray-500 mt-1 leading-relaxed">
                    Merci pour votre inscription ! Avant de commencer, veuillez vérifier votre adresse e-mail en cliquant sur le lien que nous venons de vous envoyer.
                </p>
            </div>

            <!-- Message d'état (Succès renvoi) -->
            @if (session('status') == 'verification-link-sent')
                <div class="mb-6 bg-green-50 text-green-700 p-3 rounded-lg text-sm border border-green-200">
                    Un nouveau lien de vérification a été envoyé à l'adresse e-mail que vous avez fournie lors de l'inscription.
                </div>
            @endif

            <!-- Formulaire de renvoi -->
            <form wire:submit.prevent="resend" class="mb-6">
                <button type="submit" class="w-full bg-indigo-600 text-white py-2.5 rounded-lg font-medium hover:bg-indigo-700 transition shadow-md flex items-center justify-center">
                    <span wire:loading.remove>Renvoyer l'e-mail de vérification</span>
                    <span wire:loading>Envoi en cours...</span>
                </button>
            </form>

            <div class="text-center md:text-left">
                <button wire:click="logout" type="button" class="text-sm text-gray-500 hover:text-gray-900 underline font-medium">
                    Se déconnecter
                </button>
            </div>
        </div>

        <!-- Panneau Visuel -->
        <div class="hidden md:flex relative bg-indigo-900 items-center justify-center p-12 overflow-hidden">
            <!-- Image de fond -->
            <div class="absolute inset-0 bg-cover bg-center opacity-30 mix-blend-overlay" style="background-image: url('https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&q=80&w=1000');"></div>
            <div class="absolute inset-0 bg-linear-to-br from-indigo-900/90 to-indigo-800/85"></div>

            <!-- Contenu textuel par-dessus l'image -->
            <div class="relative z-10 text-white text-center max-w-sm">
                <span class="inline-block px-3 py-1 bg-white/10 text-indigo-200 backdrop-blur-sm rounded-full text-xs font-semibold tracking-wider uppercase mb-4">
                    Validation du Compte
                </span>
                <h3 class="text-2xl font-bold mb-3">Plus qu'une étape</h3>
                <p class="text-indigo-200 text-sm leading-relaxed">
                    La validation de votre adresse e-mail garantit la sécurité de votre compte et vous permet de recevoir toutes vos confirmations de réservation en toute sérénité.
                </p>
            </div>
        </div>

    </div>
</div>
