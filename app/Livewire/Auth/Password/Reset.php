<?php

namespace App\Livewire\Auth\Password;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Rule;

class Reset extends Component
{
    public ?string $token = null;

    #[Rule(['required', 'email', 'confirmed'])]
    public ?string $email = null;

    #[Rule(['required', 'same:email'])]
    public ?string $email_confirmation = null;

    #[Rule(['required', 'confirmed', 'min:6'])]
    public ?string $password = null;

    public ?string $password_confirmation = null;

    public function mount(?string $token = null, ?string $email = null): void
    {
        $this->token = request('token', $token);
        $this->email = request('email', $email);

        if ($this->tokenNotValid()) {
            session()->flash('status', 'Invalid or expired token.');
            $this->redirectRoute('login');
        }
    }

    #[Layout('components.layouts.guest')]
    public function render()
    {
        return view('livewire.auth.password.reset');
    }

    public function updatePassword(): void
    {
        $this->validate();
    
        $status = Password::reset(
            $this->only('email', 'password', 'password_confirmation', 'token'),
            function(User $user, $password) {
                $user->password = Hash::make($password); 
                $user->remember_token = Str::random(60);
                $user->save();
    
                event(new PasswordReset($user));
            }
        );
    
        session()->flash('status', __($status));
    
        if ($status !== Password::PASSWORD_RESET) {
            return;
        }
    
        $this->redirect(route('login'));
    }
    

    #[Computed]
    public function obfuscatedEmail(): string
    {
        return obfuscate_email($this->email);
    }

    private function tokenNotValid(): bool
    {
        $tokens = DB::table('password_reset_tokens')
        ->get(['token', 'email']);
    
        // Verifique se o token existe no banco para o e-mail fornecido
        foreach ($tokens as $t) {
            if ($t->email === $this->email && Hash::check($this->token, $t->token)) {
                return false; // Token válido
            }
        }
    
        return true; // Token inválido ou não encontrado
    }
    
}
