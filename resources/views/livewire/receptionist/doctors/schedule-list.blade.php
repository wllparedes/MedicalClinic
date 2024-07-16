<div>

    @include('skeletons.schedule-list')

    <section class="mt-4" wire:loading.remove>
        <x-card title="Horario del Doctor">

            <div class="flex justify-between flex-col gap-3">
                @forelse ($daysSchedules as $name => $schedules)
                    <div class="flex gap-3">
                        <span class="w-16 truncate text-xs font-semibold">
                            {{ $name }}
                        </span>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($schedules as $schedule)
                                <x-badge outline teal label="{{ getLabelScheduleHour($schedule) }}">
                                    <x-slot name="append" class="relative flex items-center w-2 h-2">
                                        <badge type="badge"
                                            class="hover:bg-teal-100 hover:rounded-md transition-all ease-out cursor-pointer"
                                            wire:click="deleteSchedule({{ $schedule }})">
                                            <x-icon name="x-mark" class="w-4 h-4" />
                                        </badge>
                                    </x-slot>
                                </x-badge>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <div class="flex items-center justify-center">
                        <p class="text-gray-500">Doctor sin horario</p>
                    </div>
                @endforelse
            </div>
        </x-card>
    </section>

</div>
