<?php

namespace App\Livewire\Auth;

use Livewire\Component;

class Logout extends Component
{
    
    public function render()
    {
        return <<<HTML
        <x-button 
            icon="o-power" 
            class="btn-circle btn-ghost btn-xs" 
            tooltip-left="logoff" 
            no-wire-navigate 
            link="/login" 
            wire:click="logout" 
        />
        HTML;
    }

    public function logout() 
    {
        auth()->logout();

        session()->invalidate();
        session()->regenerateToken();

        $this->redirect(route('login'));
    }
}
