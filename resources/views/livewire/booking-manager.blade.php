<div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 gap-8">

    <!-- Plan de salle interactif -->
    <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8 flex flex-col">
        <div class="mb-6 pb-4 border-b border-gray-100">
            <h2 class="text-xl font-bold text-gray-900">1. Plan de salle interactif</h2>
            <p class="text-sm text-gray-500 mt-0.5">Sélectionnez une salle puis choisissez votre poste.</p>
        </div>

        <!-- Onglets des Salles -->
        <div class="flex items-center space-x-2 mb-8 overflow-x-auto pb-2">
            @foreach($rooms as $room)
                <button wire:click="$set('selectedRoomId', {{ $room->id }})"
                    class="px-5 py-2.5 rounded-xl text-sm font-semibold whitespace-nowrap transition-all shadow-sm
                    {{ $selectedRoomId == $room->id ? 'bg-indigo-600 text-white shadow-indigo-100' : 'bg-gray-50 text-gray-600 hover:bg-gray-100 border border-gray-200' }}">
                    {{ $room->name }}
                </button>
            @endforeach
        </div>

        <!-- Grille des Postes -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 p-6 border border-gray-200 rounded-2xl bg-gray-50/50 min-h-87.5">
            @if($currentRoom)
                @foreach($currentRoom->desks as $desk)
                    <button wire:click="selectDesk({{ $desk->id }})"
                        wire:loading.attr="disabled"
                        class="p-4 rounded-xl border text-left transition-all duration-200 flex flex-col justify-between shadow-sm
                        {{ $selectedDeskId == $desk->id ? 'border-indigo-600 bg-indigo-50/70 ring-2 ring-indigo-400 shadow-md' : 'bg-white border-gray-200 hover:border-indigo-300' }}
                        {{ !$desk->is_active ? 'opacity-40 cursor-not-allowed bg-gray-100' : '' }}"
                        {{ !$desk->is_active ? 'disabled' : '' }}>

                        <div class="flex items-start justify-between w-full mb-3">
                            <span class="font-bold text-gray-900 text-base">{{ $desk->code }}</span>
                            @if(!$desk->is_active)
                                <span class="text-[10px] bg-gray-200 text-gray-600 px-2 py-0.5 rounded font-semibold">Indisponible</span>
                            @else
                                <span class="w-2 h-2 rounded-full {{ $selectedDeskId == $desk->id ? 'bg-indigo-600' : 'bg-emerald-500' }}"></span>
                            @endif
                        </div>

                        <div class="mb-4">
                            <span class="text-xs uppercase tracking-wider font-medium text-gray-400">{{ $desk->type }}</span>
                        </div>

                        <div class="pt-3 border-t border-gray-100 flex items-center justify-between w-full">
                            <span class="text-xs text-gray-500">Tarif</span>
                            <span class="text-sm font-extrabold text-indigo-600">{{ number_format($desk->hourly_rate, 2) }} €<span class="text-[10px] font-normal text-gray-500">/h</span></span>
                        </div>
                    </button>
                @endforeach
            @endif
        </div>
    </div>

    <!-- Options, Détails de Facturation & Paiement -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8 flex flex-col justify-between">
        <div>
            <div class="mb-6 pb-4 border-b border-gray-100">
                <h2 class="text-xl font-bold text-gray-900">2. Options & Facturation</h2>
                <p class="text-sm text-gray-500 mt-0.5">Planifiez vos horaires et validez.</p>
            </div>

            <!-- Messages Flash -->
            @if (session()->has('error'))
                <div class="mb-6 bg-red-50 text-red-700 p-4 rounded-xl text-sm border border-red-200 flex items-start shadow-sm">
                    <span>{{ session('error') }}</span>
                </div>
            @endif
            @if (session()->has('success'))
                <div class="mb-6 bg-green-50 text-green-700 p-4 rounded-xl text-sm border border-green-200 flex items-start shadow-sm">
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Champs de date -->
            <div class="space-y-4 mb-6">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">Début</label>
                    <input type="datetime-local" wire:model.live="startTime" class="w-full rounded-xl border border-gray-300 bg-gray-50/50 p-3 text-sm shadow-sm focus:ring-2 focus:ring-indigo-500">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">Fin</label>
                    <input type="datetime-local" wire:model.live="endTime" class="w-full rounded-xl border border-gray-300 bg-gray-50/50 p-3 text-sm shadow-sm focus:ring-2 focus:ring-indigo-500">
                </div>
            </div>

            <!-- Bloc Récapitulatif / Facturation détaillée -->
            <div class="bg-gray-50 p-5 rounded-2xl border border-gray-200 space-y-3 mb-6">
                <div class="flex justify-between text-sm text-gray-600">
                    <span>Poste :</span>
                    <span class="font-semibold text-gray-900">
                        @if($selectedDeskId && $currentRoom)
                            {{ optional($currentRoom->desks->find($selectedDeskId))->code ?? 'N/A' }}
                        @else
                            <span class="text-gray-400 italic">Non sélectionné</span>
                        @endif
                    </span>
                </div>
                <div class="flex justify-between text-sm text-gray-600">
                    <span>TVA (20%) :</span>
                    <span class="font-semibold text-gray-900">{{ number_format($calculatedPrice * 0.2, 2) }} €</span>
                </div>
                <div class="border-t border-gray-200 pt-3 flex justify-between items-center">
                    <span class="text-base font-bold text-gray-900">Total TTC :</span>
                    <span class="text-2xl font-extrabold text-indigo-600">{{ number_format($calculatedPrice, 2) }} €</span>
                </div>
            </div>
        </div>

        <!-- Bouton d'action -->
        <button wire:click="bookAndPay"
            wire:loading.attr="disabled"
            class="w-full bg-indigo-600 text-white py-3.5 px-4 rounded-xl font-semibold hover:bg-indigo-700 transition shadow-md flex items-center justify-center space-x-2
            {{ !$selectedDeskId ? 'opacity-50 cursor-not-allowed bg-indigo-400' : '' }}"
            {{ !$selectedDeskId ? 'disabled' : '' }}>
            <span wire:loading.remove wire:target="bookAndPay">Procéder au Paiement sécurisé</span>
            <span wire:loading wire:target="bookAndPay">Traitement en cours...</span>
        </button>
    </div>
</div>
