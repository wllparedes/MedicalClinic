<x-modal-card blur="md" title="Editar especialidad" wire:model="openEditSpecialty" width="md">

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
        <div class="col-span-1 sm:col-span-2">
            <x-input label="Nombre" wire:model.blur='editForm.name' placeholder="Ingrese el nombre" />
        </div>

        <div class="col-span-1 sm:col-span-2">
            <x-textarea label="Descripción (opcional)" placeholder="Escriba la descripción"
                wire:model.live="editForm.description" />
        </div>

    </div>

    <x-slot name="footer">
        <div class="flex justify-end gap-x-4">
            <div class="flex gap-4">
                <x-button flat secondary label="{{ __('Cancel') }}" x-on:click="close" />
                <x-mini-button rounded wire:click="update" teal icon="check" spinner="update" wire-load-enabled />
            </div>
        </div>
    </x-slot>

</x-modal-card>
