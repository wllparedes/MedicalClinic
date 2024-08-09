<div class="relative" x-data="{ open: false }" x-on:click.away="open = false">
    <button type="button" class="flex text-sm rounded-full focus:ring-4 focus:ring-secondary-200"
        x-on:click="open = !open">
        <span class="sr-only">Open user menu</span>
        <img class="w-10 h-10 rounded-full" src="{{ verifyAvatar($avatar) }}" alt="user photo">
    </button>

    <div class="absolute right-0 z-50 my-4 w-40 text-base list-none bg-white divide-y divide-gray-100 rounded shadow"
        id="dropdown-user" x-show="open" x-cloak x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90">
        <div class="px-4 py-3" role="none">
            <p class="text-sm text-gray-900 dark:text-white" role="none">
                {{ $username }}
            </p>
            <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                {{ $email }}
            </p>
        </div>
        <ul class="py-1" role="none">

            <li>
                <a href="{{ route('profile.show') }}" wire:navigate.hover
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                    role="menuitem">Perfil</a>
            </li>

            <li>
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <a href="{{ route('logout') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                        @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </a>
                </form>
            </li>
        </ul>
    </div>

</div>
