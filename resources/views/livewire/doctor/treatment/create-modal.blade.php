<div class="mb-3">
    <x-button icon="book-open" amber label="Crear nuevo tratamiento" onclick="$openModal('openCreate')" />

    <x-modal-card blur="lg" title="Crear nuevo tratamiento" wire:model="openCreate" width="md">

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

            <div class="col-span-1 sm:col-span-2">
                <x-textarea label="Tratamiento" color="warning" placeholder="Escribir el diagnóstico"
                    wire:model.blur="createForm.treatment" />
            </div>

            <div class="col-span-1 sm:col-span-2">
                <x-textarea label="Notas" color="warning" placeholder="Escribir una nota"
                    wire:model.blur="createForm.note" />
            </div>

            <div class="col-span-1 sm:col-span-2">
                <x-toggle id="size-md" name="toggle" md label="Necesita medicamentos"
                    wire:model.live="createForm.need_products" />
            </div>

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

</div>
