<div>
    <section class="flex gap-4 p-2 flex-wrap">
        @forelse ($patients as $patient)
            <div
                class="container-patient flex flex-col w-[220px] border border-slate-300 rounded-md shadow-md p-4 gap-4">
                <div class="container-profile w-full flex justify-center items-center relative">
                    <img class="object-cover w-20 h-20 border rounded-full border-slate-100 shadow-md"
                        src="{{ verifyMultipleAvatar($patient->file, $patient->names) }}">

                    <div class="absolute top-0 right-0">
                        <x-dropdown>
                            <x-dropdown.item label="Ver información" wire-load-enabled />
                        </x-dropdown>
                    </div>

                </div>
                <div class="container-information flex flex-col gap-2">
                    <p class="font-semibold text-sm truncate">
                        {{ $patient->full_name }}
                    </p>
                    <p class="text-xs">
                        DNI: {{ $patient->dni }}
                    </p>
                    <p class="text-xs truncate">
                        Correo: {{ $patient->email }}
                    </p>
                    <span class="text-xs truncate">
                        Teléfono: {{ $patient->phone }}
                    </span>
                </div>
                <x-button teal label="Chatear" wire-load-enabled wire:click='redirectChat' />

            </div>
        @empty
            <div class="flex items-center justify-center h-64">
                <div class="text-center">
                    <x-icon name="minus-circle" class="w-14 h-14 text-red-500 mx-auto mb-4" />
                    <h2 class="text-2xl font-semibold text-gray-700 mb-2">No se encontraron pacientes.
                    </h2>
                </div>
            </div>
        @endforelse
    </section>

    {{ $patients->links(data: ['scrollTo' => false]) }}

</div>
