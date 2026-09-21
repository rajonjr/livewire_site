<?php

namespace App\Livewire\Auth;

use Laravel\Fortify\Http\Requests\TwoFactorLoginRequest;
use Livewire\Component;

class TwoFactorChallenge extends Component
{
    public $code = '';
    public $recovery_code = '';
    public $recovery = false;

    public function login(TwoFactorLoginRequest $request)
    {
        // Utilise la requête de validation native de Fortify pour authentifier le code 2FA ou le code de secours
        $this->validate();

        $response = $request->authenticate();

        if ($response) {
            return redirect()->intended('/booking');
        }
    }

    public function render()
    {
        return view('livewire.auth.two-factor-challenge')->layout('layouts.app');
    }
}
