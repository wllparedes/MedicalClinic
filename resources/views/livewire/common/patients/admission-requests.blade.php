<div class="my-4">
    <x-card title="Solicitud de ingreso">

        <form wire:submit='admission'>
            <div class="flex flex-col gap-5">
                <div class="w-72">
                    <x-select label="Estado" placeholder="Selecciona un estado" option-label="name" option-value="value"
                        :options="$state" wire:model="status" />
                </div>
                <div class="flex justify-end">
                    <x-button icon="check" teal label="Confirmar" type="submit" wire:target='admission' />
                </div>
            </div>

        </form>

    </x-card>
</div>
