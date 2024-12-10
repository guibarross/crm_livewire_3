<div>
    <x-card title="Login" shadow class="mx-auto w-[450px]">

        @if($errors->hasAny(['invalidCredentials', 'rateLimiter']))
            <x-alert icon="o-exclamation-triangle" class="alert-warning mb-4">
                @error('invalidCredentials')
                    <span>{{ $message }}</span>
                @enderror

                @error('rateLimiter')
                    <span>{{ $message }}</span>
                @enderror
                
            </x-alert>

        @endif

        <x-form wire:submit="tryToLogin">
            <x-input label="Email" wire:model="email" />
            <x-input label="Password" wire:model="password" type="password" />

            <x-slot:actions>
                <x-button label="Reset" type="reset" />
                <x-button label="Login" class="btn-primary" type="submit" spinner="save" />
            </x-slot:actions>
        </x-form>
    </x-card>
</div>
