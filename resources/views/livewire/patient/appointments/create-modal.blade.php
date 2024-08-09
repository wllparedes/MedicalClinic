<div class="mb-3">
    <x-button icon="calendar" cyan label="Solicitar cita médica" onclick="$openModal('openRequest')" />

    <x-modal-card blur="lg" title="Solicitar cita médica" wire:model="openRequest" width="md">

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

            <div class="col-span-1 sm:col-span-2">
                <x-textarea label="Motivo" wire:model.blur="createForm.motive"
                    placeholder="Escriba el motivo de su solicitud" />
            </div>

            <div class="col-span-1 sm:col-span-2">
                <x-datetime-picker wire:model="createForm.date" label="Fecha" timezone="America/Lima" without-time
                    clearable="0" without-tips="1" :disabled-weekdays="[0, 6]" placeholder="Seleccione el dia de la consulta" />
            </div>

            <div class="col-span-1 sm:col-span-2">
                <livewire:radio-two wire:model.live='createForm.type' label="Tipo" leftLabel="Normal"
                    rightLabel="Virtual" />
            </div>

            <div class="col-span-1 sm:col-span-2">
                <x-textarea label="Mensaje (opcional)" wire:model.blur="createForm.message"
                    placeholder="Escriba un mensaje" />
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
