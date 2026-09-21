<div class="bg-white p-6 sm:p-8 rounded-2xl shadow-sm border border-gray-100 max-w-2xl mx-auto my-6">
    <!-- En-tête de section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6 pb-4 border-b border-gray-100">
        <div>
            <h3 class="text-lg font-bold text-gray-900">Authentification à deux facteurs (2FA)</h3>
            <p class="text-sm text-gray-500 mt-1">Renforcez la sécurité de votre compte en activant une couche de protection supplémentaire.</p>
        </div>
        <div>
            @if(auth()->user()->two_factor_secret)
                <span class="inline-flex items-center px-3 py-1 bg-green-50 text-green-700 text-xs font-semibold rounded-full border border-green-200">
                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span> Activé
                </span>
            @else
                <span class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-600 text-xs font-semibold rounded-full border border-gray-200">
                    Désactivé
                </span>
            @endif
        </div>
    </div>

    <!-- Messages de succès -->
    @if (session()->has('success'))
        <div class="mb-6 bg-green-50 text-green-700 p-4 rounded-xl text-sm border border-green-200 flex items-center">
            <svg class="w-5 h-5 text-green-500 mr-2 flex-shrink0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            {{ session('success') }}
        </div>
    @endif

    @if(auth()->user()->two_factor_secret)
        <div class="space-y-6">
            <div class="bg-indigo-50/50 border border-indigo-100 p-4 rounded-xl text-sm text-indigo-900">
                <p class="font-medium mb-1">La 2FA est actuellement activée sur votre compte.</p>
                <p class="text-indigo-700 text-xs">Scannez le QR code ci-dessous avec votre application d'authentification favorite (Google Authenticator, Authy, 1Password, etc.).</p>
            </div>

            <!-- QR Code Container -->
            <div class="flex flex-col sm:flex-row items-center gap-6 bg-gray-50 p-6 rounded-xl border border-gray-200">
                <div class="bg-white p-3 rounded-xl shadow-sm border border-gray-100 flex items-center justify-center">
                    {!! auth()->user()->twoFactorQrCodeSvg() !!}
                </div>
                <div class="text-center sm:text-left text-sm text-gray-600 space-y-2">
                    <p class="font-semibold text-gray-800">Application d'authentification</p>
                    <p class="text-xs text-gray-500 leading-relaxed">En cas de perte de votre appareil, vous pourrez utiliser l'un de vos codes de récupération d'urgence ci-dessous.</p>
                </div>
            </div>

            <!-- Codes de récupération -->
            <div>
                <h4 class="font-semibold text-sm text-gray-800 mb-2">Codes de récupération d'urgence :</h4>
                <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 grid grid-cols-1 sm:grid-cols-2 gap-2 font-mono text-xs text-gray-700">
                    @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes), true) as $code)
                        <div class="bg-white p-2 rounded border border-gray-100 select-all tracking-wider text-center">{{ $code }}</div>
                    @endforeach
                </div>
            </div>

            <!-- Bouton Désactiver -->
            <div class="pt-4 border-t border-gray-100 flex justify-end">
                <button wire:click="disableTwoFactor" wire:loading.attr="disabled" class="bg-red-600 hover:bg-red-700 text-white font-medium px-5 py-2.5 rounded-lg transition text-sm shadow-sm flex items-center">
                    <span wire:loading.remove wire:target="disableTwoFactor">Désactiver la 2FA</span>
                    <span wire:loading wire:target="disableTwoFactor">Désactivation...</span>
                </button>
            </div>
        </div>
    @else
        <!-- État désactivé / Bouton Activer -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <p class="text-sm text-gray-600">
                Protégez votre compte contre les accès non autorisés en exigeant un code à usage unique lors de vos connexions.
            </p>
            <button wire:click="enableTwoFactor" wire:loading.attr="disabled" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-5 py-2.5 rounded-lg transition text-sm shadow-md flex items-center shrink-0">
                <span wire:loading.remove wire:target="enableTwoFactor">Activer la 2FA</span>
                <span wire:loading wire:target="enableTwoFactor">Activation...</span>
            </button>
        </div>
    @endif

    <!-- Étape de Confirmation du Code -->
    @if($confirming && !auth()->user()->hasEnabledTwoFactorAuthentication())
        <div class="mt-8 pt-6 border-t border-gray-200 bg-gray-50 -mx-6 -mb-6 p-6 rounded-b-2xl">
            <h4 class="font-semibold text-sm text-gray-900 mb-2">Confirmer le code d'activation</h4>
            <p class="text-xs text-gray-500 mb-4">Veuillez entrer le code à 6 chiffres affiché sur votre application pour finaliser l'activation.</p>

            <div class="flex flex-col sm:flex-row gap-3">
                <input type="text" wire:model="code" placeholder="123456" autofocus class="border border-gray-300 rounded-lg p-2.5 text-sm w-full sm:w-48 tracking-widest text-center font-semibold bg-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm">
                <button wire:click="confirmTwoFactor" wire:loading.attr="disabled" class="bg-green-600 hover:bg-green-700 text-white font-medium px-5 py-2.5 rounded-lg transition text-sm shadow-sm flex items-center justify-center">
                    <span wire:loading.remove wire:target="confirmTwoFactor">Confirmer & Activer</span>
                    <span wire:loading wire:target="confirmTwoFactor">Vérification...</span>
                </button>
            </div>
            @error('code') <span class="text-red-500 text-xs mt-2 block font-medium">{{ $message }}</span> @enderror
        </div>
    @endif
</div>
