<x-card>

    <div class="relative flex flex-col items-start space-y-4 sm:flex-row sm:space-y-0 sm:space-x-6 px-4 py-8">
        <span class="absolute top-0 left-0 rounded-br-lg rounded-tl-lg px-2 py-1">
            @if ($user->active)
                <x-badge rounded positive label="Activo" />
            @else
                <x-badge rounded negative label="Inactivo" />
            @endif
        </span>

        <div class="w-full flex justify-center sm:justify-start sm:w-auto">
            <img class="object-cover w-20 h-20 mt-3 mr-3 rounded-full border border-slate-200 shadow-lg"
                src="{{ verifyMultipleAvatar($user->file, $user->names) }}">
        </div>

        <div class="w-full sm:w-auto flex flex-col items-center sm:items-start">

            <p class="font-display mb-2 text-2xl font-semibold" itemprop="author">
                {{ $user->full_name }}
            </p>

            <div class="flex gap-3 justify-start flex-wrap">
                <div class="text-sm text-gray-600 dark:text-gray-400">
                    <span class="font-semibold">DNI:</span>
                    {{ $user->dni }}
                </div>
                <div class="text-sm text-gray-600 dark:text-gray-400">
                    <span class="font-semibold">Telefono:</span>
                    {{ $user->phone }}
                </div>
                <div class="text-sm text-gray-600 dark:text-gray-400">
                    <span class="font-semibold">Telefono de emergencia:</span>
                    {{ $user->emergency_phone ?? '-' }}
                </div>
            </div>
            <div class="flex gap-2 justify-start flex-wrap">
                <div class="text-sm text-gray-600 dark:text-gray-400">
                    <span class="font-semibold">Correo:</span>
                    {{ $user->email }}
                </div>
                <div class="text-sm text-gray-600 dark:text-gray-400">
                    <span class="font-semibold">Genéro:</span>
                    {{ getGenderName($user->gender) }}
                </div>
                <div class="text-sm text-gray-600 dark:text-gray-400">
                    <span class="font-semibold">Cargo:</span>
                    {{ getRoleName($user->role) }}
                </div>
            </div>
        </div>

    </div>

</x-card>
