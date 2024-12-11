<?php

namespace App\Livewire\Auth\Password;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Reset extends Component
{

    public ?string $token = null;

    public function mount()
    {
        $this->token = request('token');

        if($this->tokenNotValid()) {
            session()->flash('Token Invalid');
            $this->redirectRoute('login');
        }
    }

    #[Layout('components.layouts.guest')]
    public function render()
    {
        return view('livewire.auth.password.reset');
    }

    private function tokenNotValid(): bool
    {
        $tokens = DB::table('password_reset_tokens')->get(['token']);

        foreach ($tokens as $t) {
            if(Hash::check($t->token, $this->token)){
                return false;
            }
        }

        return true;

    }
}
