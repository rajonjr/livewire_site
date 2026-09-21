<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Login extends Component
{
    public $email = '';
    public $password = '';
    public $remember = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    public function login()
    {
        $this->validate();

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        // Régénération de la session pour la sécurité
        session()->regenerate();

        // Redirection vers le tableau de bord ou la page de réservation
        return redirect()->intended('/booking');
    }

    public function render()
    {
        return view('livewire.auth.login')->layout('layouts.app');
    }
}
