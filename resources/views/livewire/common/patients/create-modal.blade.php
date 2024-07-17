<div class="mb-3">
    <x-button icon="users" sky label="Crear nuevo paciente" onclick="$openModal('openCreate')" />

    <x-modal-card blur="md" title="Crear nuevo paciente" wire:model="openCreate" width="6xl">

        <div class="container-create-user w-full flex flex-col gap-5">

            <div class="first-element">

                <p class="font-bold text-xs mb-5 underline underline-offset-8">
                    DETALLES DEL PACIENTE
                </p>

                <div class="flex gap-5 flex-wrap container-inputs">
                    <div class="w-64">
                        <x-input label="Nombres" placeholder="Ingrese los nombres" wire:model.blur='createForm.names' />
                    </div>

                    <div class="w-64">
                        <x-input label="Apellidos" placeholder="Ingrese los apellidos"
                            wire:model.blur='createForm.last_names' />
                    </div>

                    <div class="w-64">
                        <x-input label="Nombre de usuario" placeholder="Ingrese el nombre de usuario"
                            wire:model.blur='createForm.username' />
                    </div>

                    <div class="w-64">
                        <x-maskable label="DNI" mask="##-##-##-##" placeholder="Ingrese el dni"
                            wire:model.blur='createForm.dni' />
                    </div>

                    <div class="w-64">

                        <x-maskable label="Telefono" mask="(+51) ###-###-###" placeholder="Ingrese el número telefonico"
                            wire:model.blur='createForm.phone' />
                    </div>

                    <div class="w-64">
                        <x-maskable label="Telefono de emergencia (opcional)" mask="(+51) ###-###-###"
                            placeholder="Ingrese el número de emergencia"
                            wire:model.blur='createForm.emergency_phone' />
                    </div>

                    <div class="w-64">
                        <x-input label="Correo (opcional)" placeholder="Ingrese el correo"
                            wire:model.blur='createForm.email' />
                    </div>

                    <div class="w-64">
                        <x-datetime-picker wire:model="createForm.birthday" label="Fecha de nacimiento" without-time
                            timezone="America/Lima" placeholder="Seleccione la fecha de nacimiento" />
                    </div>

                    <div class="w-64">
                        <livewire:radio-two wire:model='createForm.gender' label="Género" leftLabel="Hombre"
                            rightLabel="Mujer" />
                    </div>

                    <div class="w-64">
                        <x-password label="Contraseña" wire:model.blur="createForm.password"
                            placeholder="Ingrese su contraseña" />
                    </div>

                </div>

            </div>

        </div>

        <x-slot name="footer">
            <div class="flex justify-end gap-x-4">
                <div class="flex gap-4">
                    <x-button flat secondary label="{{ __('Cancel') }}" x-on:click="close" />
                    <x-mini-button rounded wire:click="save" sky icon="check" spinner="save" />
                </div>
            </div>
        </x-slot>

    </x-modal-card>

</div>
