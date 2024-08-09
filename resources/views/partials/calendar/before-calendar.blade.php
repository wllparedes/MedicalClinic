<div class="mb-3 flex justify-between gap-3 flex-wrap">
    <x-button black xs icon="chevron-double-left" label="Anterior" wire:click='goToPreviousMonth' class="cursor-pointer"
        wire-load-enabled="1" />

    <x-button white sm icon="calendar" label="Mes actual" wire:click='goToCurrentMonth' class="cursor-pointer"
        interaction="cyan" wire-load-enabled="1" />

    <x-button black xs right-icon="chevron-double-right" label="Siguiente" wire:click='goToNextMonth'
        wire-load-enabled="1" class="cursor-pointer" />
</div>
