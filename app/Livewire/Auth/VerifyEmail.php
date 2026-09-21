<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VerifyEmail extends Component
{
    public function resend()
    {
        if (auth()->user()->hasVerifiedEmail()) {
            return redirect()->intended('/booking');
        }

        auth()->user()->sendEmailVerificationNotification();

        session()->flash('status', 'verification-link-sent');
    }

    public function logout()
    {
        Auth::guard('web')->logout();

        session()->invalidate();
        session()->regenerateToken();

        return redirect('/login');
    }

    public function render()
    {
        return view('livewire.auth.verify-email')->layout('layouts.app');
    }
}
