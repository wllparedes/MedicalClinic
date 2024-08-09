<x-modal-card blur="lg" title="Agregar medicamentos" wire:model="openAddForm" width="md">

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

        <div class="col-span-1 sm:col-span-2">
            <x-select label="Productos" color="warning" placeholder="Seleccione el producto" :options="$products"
                clearable="0" option-label="name" option-description="description" option-value="id"
                wire:model.live='product' />
        </div>

        <x-input placeholder="horas a tomar" color="warning" wire:model.blur="hours" />
        <x-input placeholder="cantidad a tomar" color="warning" wire:model.blur="quantity" />

    </div>

    <x-slot name="footer">
        <div class="flex justify-end gap-x-4">
            <div class="flex gap-4">
                <x-button flat secondary label="{{ __('Cancel') }}" x-on:click="close" />
                <x-mini-button rounded wire:click="save" amber icon="check" wire-load-enabled spinner="save" />
            </div>
        </div>
    </x-slot>

</x-modal-card>
