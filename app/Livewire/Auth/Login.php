<?php

namespace App\Livewire\Auth;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;
use Livewire\Component;
use Spatie\LaravelRay\Ray;

class Login extends Component
{
    public string $email;

    public string $password;

    public function render(): View
    {
        return view('livewire.auth.login');
    }

    public function tryToLogin(): void
    {

        if(RateLimiter::tooManyAttempts($this->throttleKey, maxAttempts: 5)) {

            $this->addError('rateLimiter', trans('auth.throttle', [
                'seconds' => RateLimiter::availableIn($this->throttleKey),
            ]));


            return;

        };

        if (! Auth::attempt(['email' => $this->email, 'password'])) {

            RateLimiter::hit($this->throttleKey);

            $this->addError('invalidCredentials', trans('auth.failed'));

            return;

        }

        $this->redirect(route('dashboard'));
    }

    public function throttleKey()
    {
        return Str::transliterate( Str::lower($this->email) . '|' . request()->ip());
    }
}
