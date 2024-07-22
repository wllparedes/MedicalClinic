<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        Información Personal
    </x-slot>

    <x-slot name="description">
        Actualiza tu información personal.
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-maskable label="DNI" placeholder="Ingresa tu dni" mask="##-##-##-##" id="dni"
                class="mt-1 block w-full" wire:model.blur="updateForm.dni" />

            <x-input-error for="dni" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-maskable label="Telefono" placeholder="Ingresa tu telefono" mask="(+51) ###-###-###" id="phone"
                class="mt-1 block w-full" wire:model.blur="updateForm.phone" />

            <x-input-error for="phone" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-input id="username" label="Nombre de usuario" placeholder="Ingresa tu nombre de usuario"
                class="mt-1 block w-full" wire:model.blur="updateForm.username" />
            <x-input-error for="username" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo" cyan type="submit">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
