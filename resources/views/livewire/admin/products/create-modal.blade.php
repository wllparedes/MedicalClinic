<div class="mb-3">
    <x-button icon="beaker" sky label="Crear nuevo producto" onclick="$openModal('openCreate')" />

    <x-modal-card blur="lg" title="Crear nuevo producto" wire:model="openCreate" width="md">

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

            <div class="col-span-1 sm:col-span-2">
                <x-input label="Nombre" wire:model.blur='createForm.name' placeholder="Ingrese el nombre" />
            </div>

            <div class="col-span-1 sm:col-span-2">
                <x-textarea label="Descripción (opcional)" wire:model.blur='createForm.description'
                    placeholder="Escriba la descripción del producto" />
            </div>

            <div class="col-span-1 sm:col-span-2">
                <x-select label="Categoria" placeholder="Seleccione una categoria" right-icon="bookmark"
                    wire:model.live='createForm.category_id' :async-data="route('api.categories.all')" option-label="name" option-value="id" />
            </div>

            <div class="col-span-1 sm:col-span-2">
                @unless ($createForm->category_id)
                    <x-select label="Subcategorias" placeholder="Seleccione las subcategorias" clearable="0"
                        right-icon="bookmark" wire:model.live='createForm.subcategories_id' disabled multiselect />
                @else
                    <x-select label="Subcategorias" placeholder="Seleccione las subcategorias" clearable="0"
                        right-icon="bookmark" wire:model.live='createForm.subcategories_id' :async-data="route('api.categories.getSubcategories', ['category' => $createForm->category_id])"
                        option-label="name" option-value="id" multiselect />
                @endunless
            </div>

            <div class="col-span-1 sm:col-span-2">
                <div x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true" class="w-full"
                    x-on:livewire-upload-finish="uploading = false, progress = 0"
                    x-on:livewire-upload-cancel="uploading = false, progress = 0"
                    x-on:livewire-upload-error="uploading = false, progress = 0"
                    x-on:livewire-upload-progress="progress = $event.detail.progress">

                    <div
                        class="relative col-span-1 sm:col-span-2 cursor-pointer bg-gray-100 rounded-xl shadow-md h-44 w-full flex items-center justify-center">
                        <div class="flex flex-col items-center justify-center w-full">

                            @if (!$createForm->image)
                                <x-icon name="cloud-arrow-up" class="w-16 h-16 text-blue-600" />
                                <p class="text-blue-600 text-sm">Click o deja caer la imagen</p>
                                <p class="text-blue-900 text-xs">(Requerido)</p>
                            @else
                                <img src="{{ $createForm->image->temporaryUrl() }}" class="object-contain w-full h-44">
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
