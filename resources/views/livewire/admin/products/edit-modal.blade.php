<x-modal-card blur="lg" title="Editar producto" wire:model="openEdit" width="md">

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

        <div class="col-span-1 sm:col-span-2">
            <x-input label="Nombre" wire:model.blur='editForm.name' placeholder="Ingrese el nombre" />
        </div>

        <div class="col-span-1 sm:col-span-2">
            <x-textarea label="Descripción (opcional)" wire:model.blur='editForm.description'
                placeholder="Escriba la descripción del producto" />
        </div>

        <div class="col-span-1 sm:col-span-2">
            <x-select label="Categoria" placeholder="Seleccione una categoria" right-icon="bookmark" clearable="0"
                option-value="id" option-label="name" wire:model.live='editForm.category_id' :options="$categories" />
        </div>

        <div class="col-span-1 sm:col-span-2">
            @unless ($editForm->category_id)
                <x-select label="Subcategorias" placeholder="Seleccione las subcategorias" clearable="0"
                    right-icon="bookmark" wire:model.live='editForm.subcategories_id' disabled multiselect :options="$subcategories"
                    option-value="id" option-label="name" />
            @else
                <x-select label="Subcategorias" placeholder="Seleccione las subcategorias" clearable="0"
                    right-icon="bookmark" wire:model.live='editForm.subcategories_id' :options="$subcategories" option-label="name"
                    option-value="id" multiselect />
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

                        @if (!$editForm->image and !$imageUrl)
                            <x-icon name="cloud-arrow-up" class="w-16 h-16 text-blue-600" />
                            <p class="text-blue-600 text-sm">Click o deja caer la imagen</p>
                            <p class="text-blue-900 text-xs">(requerido)</p>
                        @elseif ($imageUrl and !$editForm->image)
                            <img src="{{ verifyImage($imageUrl) }}" class="object-contain w-full h-44">
                        @elseif ($editForm->image)
                            <img src="{{ $editForm->image->temporaryUrl() }}" class="object-contain w-full h-44">
                        @endif

                        <input type="file" wire:model.live="editForm.image" accept="image/jpeg,png,jpeg"
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

                <x-badge flat dark label="Cancelar subida" x-on:click="$wire.cancelUpload('editForm.image')"
                    x-show="uploading" class="z-10 my-1 mt-1 text-xs cursor-pointer" />

                @if ($editForm->image)
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
                <x-mini-button rounded wire:click="update" cyan icon="check" spinner="update" />
            </div>
        </div>
    </x-slot>

</x-modal-card>
