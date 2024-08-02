<section class="container-diagnosis-treatments w-full flex gap-4 flex-col">

    <div class="diagnosis border border-dashed border-teal-600 p-4 rounded-md">

        @if (!$appointment->diagnosis)
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <x-textarea label="Diagnóstico" color="info" rows="2" placeholder="Escribir el diagnóstico"
                    wire:model.blur="createForm.diagnosis" />
                <x-textarea label="Prescripción" color="info" rows="2" placeholder="Escribir la preescripción"
                    wire:model.blur="createForm.prescription" />
                <x-textarea label="Notas" color="info" rows="2" placeholder="Escribir una nota"
                    wire:model.blur="createForm.note" />

                <div class="col-span-1 sm:col-span-2">
                    <x-toggle id="size-xl" name="toggle" label="Tratamiento" lg color="info"
                        description="Al activarlo, añades tratamientos para el paciente."
                        wire:model.live="createForm.need_treatment" />
                </div>

                <div class="col-span-1 sm:col-span-2">
                    <x-button teal label="Guardar" wire:click="save" wire-load-enabled spinner="save" />
                </div>
            </div>
        @else
            <section>
                <div class="flex gap-3 justify-start flex-wrap">
                    <div class="text-sm">
                        <span class="font-semibold text-gray-600">Diagnostico:</span>
                        <span class="text-gray-500 italic">
                            {{ $appointment->diagnosis->diagnosis }}
                        </span>
                    </div>
                </div>
                <div class="flex gap-3 justify-start flex-wrap">
                    <div class="text-sm">
                        <span class="font-semibold text-gray-600">Prescripción:</span>
                        <span class="text-gray-500 italic">
                            {{ $appointment->diagnosis->prescription }}
                        </span>
                    </div>
                </div>
                <div class="flex gap-3 justify-start flex-wrap">
                    <div class="text-sm">
                        <span class="font-semibold text-gray-600">Notas:</span>
                        <span class="text-gray-500 italic">
                            {{ $appointment->diagnosis->note ?? '-' }}
                        </span>
                    </div>
                </div>
                <div class="flex gap-3 justify-start flex-wrap">
                    <div class="text-sm">
                        <span class="font-semibold text-gray-600">Necesita tratamiento:</span>
                        <span class="text-gray-500 italic">
                            {{ $appointment->diagnosis->need_treatment ? 'SI' : 'NO' }}
                        </span>
                    </div>
                </div>
            </section>
        @endif

    </div>

</section>
