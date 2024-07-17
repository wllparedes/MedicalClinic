<x-modal-card blur="md" title="Editar horario del doctor" wire:model="openSchedule" max-width="xl">

    @if ($openSchedule)
        <p class="font-bold text-sm mb-5 underline underline-offset-8">
            {{ $doctor->full_name }}
        </p>
    @endif

    <form wire:submit='save'>

        <div class="flex flex-wrap gap-4 mt-2 mx-8">

            @error('scheduleExists')
                <x-alert title="{{ $message }}" warning rounded="md" />
            @enderror

            <div class="flex flex-wrap gap-4">
                @foreach ($daysWork as $day)
                    @if ($day->its_workday)
                        <x-radio id="{{ $day->cod }}" label="{{ $day->name }}" wire:model.blur="createForm.day"
                            value="{{ $day->id }}" />
                    @else
                        <x-radio id="{{ $day->cod }}" label="{{ $day->name }}" wire:model.blur="createForm.day"
                            value="{{ $day->id }}" disabled />
                    @endif
                @endforeach
            </div>

            <div class="flex flex-wrap gap-4">
                <div class="w-52">
                    <x-time-picker id="from" wire:model.live="createForm.start" label="De"
                        placeholder="12:00 AM" without-seconds />
                </div>
                <div class="w-52">
                    <x-time-picker id="for" wire:model.live="createForm.end" label="A" placeholder="15:00 PM"
                        without-seconds />
                </div>
                <div class="w-20 flex justify-center items-center">
                    <x-mini-button cyan rounded icon="plus" type="submit" />
                </div>
            </div>

        </div>
    </form>

    <hr class="h-px my-4 mx-8 bg-gray-200 border-0">

    <livewire:receptionist.doctors.schedule-list />

</x-modal-card>
