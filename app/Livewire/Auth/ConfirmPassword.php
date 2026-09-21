<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class ConfirmPassword extends Component
{
    public $password = '';

    protected $rules = [
        'password' => 'required',
    ];

    public function confirm()
    {
        $this->validate();

        // Vérification du mot de passe par rapport à l'utilisateur connecté
        if (! Hash::check($this->password, auth()->user()->password)) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        // Enregistrement de la confirmation dans la session pour la durée requise par Laravel
        session(['auth.password_confirmed_at' => time()]);

        // Redirection vers la page prévue initialement
        return redirect()->intended('/booking');
    }

    public function render()
    {
        return view('livewire.auth.confirm-password')->layout('layouts.app');
    }
}
