<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Password;
use Livewire\Component;

class ForgotPassword extends Component
{
    public $email = '';

    protected $rules = [
        'email' => 'required|email|exists:users,email',
    ];

    public function sendResetLink()
    {
        $this->validate();

        // Envoi du lien de réinitialisation via le broker de Laravel
        $status = Password::sendResetLink(['email' => $this->email]);

        if ($status === Password::RESET_LINK_SENT) {
            session()->flash('status', __($status));
            $this->reset('email');
            return;
        }

        session()->flash('email', __($status));
    }

    public function render()
    {
        return view('livewire.auth.forgot-password')->layout('layouts.app');
    }
}
