<div>
    <x-card title="Password Reset" shadow class="mx-auto w-[450px]">

        @if ($message = session()->get('status'))
            <x-alert icon="o-exclamation-triangle" class="alert-error mb-4">
                {{ $message }}
            </x-alert>
        @endif


        <x-form wire:submit="updatePassword">
            <x-input label="Email" value="{{ $this->obfuscatedEmail }}" readonly />
            <x-input label="Email Confirmation" wire:model="email_confirmation" />
            <x-input label="Password" wire:model="password" type="password" />
            <x-input label="Password Confirmation" wire:model="password_confirmation" type="password" />
            <x-slot:actions>
                <div class="w-full">
                    <div class="text-center mb-3">
                        <x-button label="Reset" class="btn-primary" type="submit" spinner="save" />
                    </div>
                    <div class="text-center">
                        <a wire:navegate href="{{ route('login') }}" class="link link-primary">Never mind, get back to
                            login page.</a>
                    </div>
                </div>
            </x-slot:actions>
        </x-form>
    </x-card>
</div>
