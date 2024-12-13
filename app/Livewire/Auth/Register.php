<?php

namespace App\Livewire\Auth;

use App\Models\User;
use App\Notifications\WelcomeNotification;
use Illuminate\Contracts\View\View;
use App\Providers\RouteServiceProvider;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;


class Register extends Component
{

    #[Rule(['required', 'max:255'])]
    public ?string $name = null;

    #[Rule(['required', 'email', 'max:255', 'confirmed'])]
    public ?string $email = null;

    #[Rule(['required'])]
    public ?string $email_confirmation = null;

    #[Rule(['required'])]
    public ?string $password = null;

    #[Layout('components.layouts.guest')]
    public function render(): View
    {
        return view('livewire.auth.register');
    }


    public function submit(): void
    {
        $this->validate();

        if (User::where('email', $this->email)->exists()) {
            $this->addError('email', 'O e-mail já está cadastrado.');
            return;
        }

        /** @var \App\Models\User $user */
        $user = User::query()->create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password), // Certifique-se de criptografar a senha
        ]);

        auth()->login($user);

        $user->notify(new WelcomeNotification);

        $this->redirect(RouteServiceProvider::HOME);
    }
}
