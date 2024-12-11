<div>
    <x-card title="Login" shadow class="mx-auto w-[450px]">

        @if ($message = session()->get('status'))
            <x-alert icon="o-exclamation-triangle" class="alert-error mb-4">
                {{ $message }}
            </x-alert>
        @endif

        @if ($errors->hasAny(['invalidCredentials', 'rateLimiter']))
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
                <div class="w-full">
                    <div class="text-center mb-3">
                        <x-button label="Login" class="btn-primary" type="submit" spinner="save" />
                    </div>
                    <div class="text-center mb-3">
                        <a wire:navegate href="{{ route('auth.register') }}" class="link link-primary">I want to
                            create an account</a>
                    </div>
                    <div class="w-full text-sm text-center">
                        <a wire:navegate href="{{ route('password.recovery') }}" class="link link-primary">Forgot
                            your password?</a>
                    </div>
                </div>
            </x-slot:actions>
        </x-form>
    </x-card>
</div>
