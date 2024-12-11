<div>
    <x-card title="Password recovery" shadow class="mx-auto w-[450px]">

        @if ($message)
            <x-alert icon="o-exclamation-triangle" class="alert-success mb-4">
                <span>You will receive an email with the password recovery link.</span>
            </x-alert>
        @endif

        <x-form wire:submit="startPasswordRecovery">
            <x-input label="Email" wire:model="email" />

            <x-slot:actions>
                <div class="w-full">
                    <div class="text-center mb-3">
                        <x-button label="Submit" class="btn-primary" type="submit" spinner="save" />
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
