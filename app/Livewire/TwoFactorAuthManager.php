<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Actions\ConfirmTwoFactorAuthentication;
use Laravel\Fortify\Actions\DisableTwoFactorAuthentication;
use Laravel\Fortify\Actions\EnableTwoFactorAuthentication;
use Livewire\Component;

class TwoFactorAuthManager extends Component
{
    public $code = '';
    public $confirming = false;

    public function enableTwoFactor(EnableTwoFactorAuthentication $enable)
    {
        $enable(Auth::user());
        $this->confirming = true;
    }

    public function confirmTwoFactor(ConfirmTwoFactorAuthentication $confirm)
    {
        $confirm(Auth::user(), $this->code);
        $this->confirming = false;
        $this->reset('code');
        session()->flash('success', 'Authentification à deux facteurs activée avec succès.');
    }

    public function disableTwoFactor(DisableTwoFactorAuthentication $disable)
    {
        $disable(Auth::user());
        session()->flash('success', 'Authentification à deux facteurs désactivée.');
    }

    public function render()
    {
        return view('livewire.two-factor-auth-manager');
    }
}
