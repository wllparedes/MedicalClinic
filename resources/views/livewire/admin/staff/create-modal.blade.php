<div class="mb-3">
    <x-button icon="users" cyan label="Crear nuevo personal" onclick="$openModal('openCreate')" />

    <x-modal-card blur="md" title="Crear nuevo personal" wire:model="openCreate" width="6xl">

        <div class="container-create-user w-full flex flex-col gap-5">

            <div class="first-element">

                <p class="font-bold text-xs mb-5 underline underline-offset-8">
                    DETALLES DEL PERSONAL
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
                        <livewire:radio-two wire:model='createForm.gender' label="Género" leftLabel="Hombre"
                            rightLabel="Mujer" />
                    </div>

                    <div class="w-64">
                        <x-select label="Rol" placeholder="Selecciona un rol" :options="$roles" option-label="name"
                            option-value="value" wire:model="createForm.role" />
                    </div>

                    <div class="w-64">
                        <x-password label="Contraseña" wire:model.blur="createForm.password"
                            placeholder="Ingrese su contraseña" />
                    </div>

                </div>

            </div>

            <div class="second-element">
                <p class="font-bold text-xs mb-5 underline underline-offset-8">
                    IMAGEN DE PERFIL
                </p>

                <div class="flex gap-5">
                    <div x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true"
                        x-on:livewire-upload-finish="uploading = false, progress = 0"
                        x-on:livewire-upload-cancel="uploading = false, progress = 0"
                        x-on:livewire-upload-error="uploading = false, progress = 0"
                        x-on:livewire-upload-progress="progress = $event.detail.progress">

                        <div
                            class="relative col-span-1 sm:col-span-2 cursor-pointer bg-gray-100 rounded-xl shadow-md h-44 w-72 flex items-center justify-center">
                            <div class="flex flex-col items-center justify-center w-full">

                                @if (!$createForm->image)
                                    <x-icon name="cloud-arrow-up" class="w-16 h-16 text-blue-600" />
                                    <p class="text-blue-600 text-sm">Click o deja caer la imagen de perfil</p>
                                    <p class="text-blue-900 text-xs">(opcional)</p>
                                @else
                                    <img src="{{ $createForm->image->temporaryUrl() }}"
                                        class="object-contain w-full h-44">
                                @endif

                                <input type="file" wire:model.live="createForm.image" accept="image/jpeg,png,jpeg"
                                    class="absolute p-2 border rounded top-0 opacity-0 w-full h-full">

                            </div>
                        </div>

                        <div x-show="uploading" class="relative pt-1 w-full flex items-center flex-col mt-1">
                            <div class="overflow-hidden h-3 mb-2 text-xs flex rounded bg-blue-200 w-full">
                                <div class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500 transition-all duration-500"
                                    x-bind:style="'width:' + progress + '%'">
                                </div>
                            </div>
                            <span class="text-xs text-blue-700" x-text="progress + '%'"></span>
                        </div>

                        <x-badge flat dark label="Cancelar subida" x-on:click="$wire.cancelUpload('createForm.image')"
                            x-show="uploading" class="z-10 my-1 mt-1 text-xs cursor-pointer" />

                        @if ($createForm->image)
                            <div class="flex justify-center gap-4 mt-4" x-show="!uploading">
                                <x-button rounded negative label="Eliminar" wire:click="deletePhotoProfile" />
                            </div>
                        @endif

                        @error('image')
                            <div class="mt-3 bg-red-100 border text-xs border-red-400 text-red-700 px-2 py-1 rounded relative"
                                role="alert">
                                <strong class="font-bold">¡Error!</strong>
                                <span class="block sm:inline">{{ $message }}</span>
                            </div>
                        @enderror

                    </div>
                </div>

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
