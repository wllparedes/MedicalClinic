<x-form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('Update Password') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-password id="current_password" type="password" label="Contraseña actual" class="mt-1 block w-full"
                placeholder="Ingresa tu contraseña actual" wire:model.blur="state.current_password"
                autocomplete="current-password" />
            <x-input-error for="current_password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-password id="password" type="password" label="Contraseña nueva"
                placeholder="Ingresa tu contraseña nueva" class="mt-1 block w-full" wire:model.blur="state.password"
                autocomplete="new-password" />
            <x-input-error for="password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-password id="password_confirmation" type="password" label="Confirmar contraseña"
                placeholder="Confirma tu contraseña" class="mt-1 block w-full"
                wire:model.live="state.password_confirmation" autocomplete="new-password" />
            <x-input-error for="password_confirmation" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button sky type="submit">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
