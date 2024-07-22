<div class="mb-3">
    <x-button icon="bookmark" cyan label="Crear nueva categoria" onclick="$openModal('openCreate')" />

    <x-modal-card blur="md" title="Crear nueva categoria" wire:model="openCreate" width="md">

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div class="col-span-1 sm:col-span-2">
                <x-input label="Nombre" wire:model.blur='createForm.name' placeholder="Ingrese el nombre" />
            </div>

            <div class="col-span-1 sm:col-span-2">
                <x-input label="Slug" wire:model.live='createForm.slug' placeholder="Muestra de su slug" disabled />
            </div>
        </div>

        <x-slot name="footer">
            <div class="flex justify-end gap-x-4">
                <div class="flex gap-4">
                    <x-button flat secondary label="{{ __('Cancel') }}" x-on:click="close" />
                    <x-mini-button rounded wire:click="save" cyan icon="check" spinner="save" />
                </div>
            </div>
        </x-slot>

    </x-modal-card>

</div>
