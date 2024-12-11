<?php

namespace App\Livewire\Auth;

use App\Models\User;
use App\Notifications\PasswordRecoveryNotification;
use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Recovery extends Component
{
    public ?string $message = null;

    #[Rule(['email'])]

    public ?string $email = null;


    #[Layout('components.layouts.guest')]
    public function render()
    {
        return view('livewire.auth.recovery');
    }

    public function startPasswordRecovery()
    {
        $this->validate();

        Password::sendResetLink($this->only('email'));

        $this->message = 'You will receive an email with the password recovery link.';

    }
}
