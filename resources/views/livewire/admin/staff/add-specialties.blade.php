<x-modal-card blur="md" title="Asignar especialidades" wire:model="openAddSpecialty" width="md">

    @if ($openAddSpecialty)
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div class="col-span-1 sm:col-span-2">
                <x-select label="Especialidad" placeholder="Selecciona las especialidades" :async-data="route('api.specialties.leftovers', $user)"
                    wire:model='specialties_id' option-label="name" option-description="description" option-value="id"
                    always-fetch multiselect />
            </div>
        </div>

        <br>

        <x-card>
            <x-slot name="title" class="italic !font-bold">
                Especialidades del doctor
            </x-slot>

            <div class="flex justify-between items-center text-sm gap-2 flex-col">
                @forelse ($specialties as $specility)
                    <div
                        class="flex justify-between items-center border-dashed border-2 border-cyan-600 rounded-lg w-full p-2 gap-2 shadow-md">
                        <span>
                            {{ $specility->name }}
                        </span>
                        <span>
                            <x-mini-button 2xs rounded wire:click="deleteSpecialty({{ $specility->id }})" negative
                                icon="x-mark" wire-load-enabled />
                        </span>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">Sin especialidades asignadas.</p>
                @endforelse
            </div>

        </x-card>
    @endif


    <x-slot name="footer">
        <div class="flex justify-end gap-x-4">
            <div class="flex gap-4">
                <x-button flat secondary label="{{ __('Cancel') }}" x-on:click="close" />
                <x-mini-button rounded wire:click="add" cyan icon="check" spinner="add" wire-load-enabled />
            </div>
        </div>
    </x-slot>

</x-modal-card>
