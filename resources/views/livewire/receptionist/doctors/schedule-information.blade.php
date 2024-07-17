<div class="my-4">
    <x-card title="Horario del Doctor" class="w-1/2">
        <div class="flex justify-between flex-col gap-3">
            @forelse ($daysSchedules as $name => $schedules)
                <div class="flex gap-3">
                    <span class="w-16 truncate text-xs font-semibold">
                        {{ $name }}
                    </span>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($schedules as $schedule)
                            <x-badge outline teal label="{{ getLabelScheduleHour($schedule) }}" />
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
</div>
