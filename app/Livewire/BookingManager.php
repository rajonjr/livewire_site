<?php

namespace App\Livewire;

use App\Models\Booking;
use App\Models\Desk;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BookingManager extends Component
{
    public $selectedRoomId;
    public $selectedDeskId = null;
    public $startTime;
    public $endTime;
    public $calculatedPrice = 0;

    public function mount()
    {
        $this->selectedRoomId = Room::first()?->id;
        $this->startTime = Carbon::now()->addHour()->format('Y-m-d\TH:i');
        $this->endTime = Carbon::now()->addHours(3)->format('Y-m-d\TH:i');
    }

    public function updated($property)
    {
        if (in_array($property, ['selectedDeskId', 'startTime', 'endTime'])) {
            $this->calculatePrice();
        }
    }

    public function calculatePrice()
    {
        if (!$this->selectedDeskId || !$this->startTime || !$this->endTime) {
            $this->calculatedPrice = 0;
            return;
        }

        $start = Carbon::parse($this->startTime);
        $end = Carbon::parse($this->endTime);

        if ($end->lessThanOrEqualTo($start)) {
            $this->calculatedPrice = 0;
            return;
        }

        $hours = max(1, $start->diffInHours($end));
        $desk = Desk::find($this->selectedDeskId);

        $this->calculatedPrice = $hours * ($desk?->hourly_rate ?? 0);
    }

    public function selectDesk($deskId)
    {
        $desk = Desk::find($deskId);
        if ($desk && $desk->is_active) {
            $this->selectedDeskId = $deskId;
            $this->calculatePrice();
        }
    }

    public function bookAndPay()
    {
        $this->validate([
            'selectedDeskId' => 'required|exists:desks,id',
            'startTime' => 'required|date|after:now',
            'endTime' => 'required|date|after:startTime',
        ]);

        // Vérification des conflits de réservation
        $conflict = Booking::where('desk_id', $this->selectedDeskId)
            ->where('status', '!=', 'cancelled')
            ->where(function ($query) {
                $query->whereBetween('start_time', [$this->startTime, $this->endTime])
                      ->orWhereBetween('end_time', [$this->startTime, $this->endTime]);
            })->exists();

        if ($conflict) {
            session()->flash('error', 'Ce bureau est déjà réservé sur cette plage horaire.');
            return;
        }

        $desk = Desk::find($this->selectedDeskId);
        $amountInCents = intval($this->calculatedPrice * 100);

        try {
            // Utilisation de la méthode de checkout native de Laravel Cashier
            return Auth::user()->checkout([
                [
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => [
                            'name' => "Réservation - Bureau {$desk->code}",
                            'description' => "Du {$this->startTime} au {$this->endTime}",
                        ],
                        'unit_amount' => $amountInCents,
                    ],
                    'quantity' => 1,
                ]
            ], [
                'success_url' => route('booking.success') . '?session_id={CHECKOUT_SESSION_ID}&desk_id=' . $this->selectedDeskId . '&start=' . urlencode($this->startTime) . '&end=' . urlencode($this->endTime) . '&price=' . $this->calculatedPrice,
                'cancel_url' => route('booking.cancel'),
            ]);

        } catch (\Exception $e) {
            session()->flash('error', 'Erreur Cashier : ' . $e->getMessage());
        }
    }

    public function render()
    {
        $rooms = Room::with('desks')->get();
        $currentRoom = Room::with('desks')->find($this->selectedRoomId);

        return view('livewire.booking-manager', [
            'rooms' => $rooms,
            'currentRoom' => $currentRoom,
        ])->layout('layouts.app');
    }
}