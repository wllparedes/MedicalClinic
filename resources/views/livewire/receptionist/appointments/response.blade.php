<div class="my-4">
    <x-card title="Respuesta para la solicitud de cita">

        <form wire:submit='admission'>
            <div class="flex flex-col gap-5">
                <div class="w-72">
                    <x-select label="Estado" placeholder="Selecciona un estado" option-label="name" option-value="value"
                        :options="$state" wire:model.live="status" />
                </div>
                <div class="w-72">
                    <x-select label="Doctor" placeholder="Selecciona un doctor" :async-data="route('api.doctors.all')" option-label="names"
                        option-description="last_names" option-value="id" wire:model='doctor_id' />
                </div>
                <div class="flex justify-end">
                    <x-button icon="check" teal label="Confirmar" type="submit" wire:target='admission' />
                </div>
            </div>

        </form>

    </x-card>
</div>
