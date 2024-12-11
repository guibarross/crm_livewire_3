<?php

namespace App\Livewire\Auth;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Login extends Component
{
    public string $email = '';
    public string $password = '';

    
    #[Layout('components.layouts.guest')]
    public function render(): View
    {
        return view('livewire.auth.login');
    }

    public function tryToLogin(): void
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        
        // Verifica se há muitas tentativas
        if (RateLimiter::tooManyAttempts($this->throttleKey(), maxAttempts: 5)) {
            $this->addError('rateLimiter', trans('auth.throttle', [
                'seconds' => RateLimiter::availableIn($this->throttleKey()),
            ]));

            return;
        }

        // Tenta autenticar o usuário
        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            RateLimiter::hit($this->throttleKey());
            $this->addError('invalidCredentials', trans('auth.failed'));

            return;
        }

        // Redireciona para o dashboard após login bem-sucedido
        $this->redirect(route('dashboard'));
    }

    /**
     * Gera uma chave única para o rate limiter baseado no email e no IP.
     *
     * @return string
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email) . '|' . request()->ip());
    }
}
