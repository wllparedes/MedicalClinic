<div class="mb-3">
    <x-button icon="bookmark" teal label="Crear nueva subcategoria" onclick="$openModal('openCreateSub')" />

    <x-modal-card blur="md" title="Crear nueva subcategoria" wire:model="openCreateSub" width="md">

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div class="col-span-1 sm:col-span-2">
                <x-select label="Categoria" placeholder="Selecciona una categoria" :async-data="route('api.categories.all')" always-fetch
                    option-label="name" option-value="id" option-description="slug"
                    wire:model.live='createForm.category' />
            </div>

            @if ($createForm->category)
                <div class="col-span-1 sm:col-span-2 border border-slate-300 rounded-md p-2">

                    <div class="flex mb-1 justify-between items-end" name="form.wrapper.header">
                        <label class="block text-sm font-medium disabled:opacity-60 text-gray-700">
                            Subcategorias:
                        </label>
                    </div>

                    @forelse ($this->loadSubcategories() as $sub)
                        <div class="flex justify-between items-center text-sm">
                            <li> {{ $sub->name }} </li>
                            {{-- <x-mini-button 2xs rounded wire:click="selectSubcategory({{ $sub->id }})" negative
                                icon="x-mark" /> --}}
                        </div>
                    @empty
                        <p class="text-sm text-slate-500">No hay subcategorias</p>
                    @endforelse
                </div>
            @endif

            <div class="col-span-1 sm:col-span-2">
                <x-input label="Nombre de la subcategoria" wire:model.blur='createForm.name'
                    placeholder="Ingrese el nombre" />
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
