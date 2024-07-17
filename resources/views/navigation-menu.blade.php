<nav class="fixed top-0 z-50 w-full bg-slate-100 border-slate-300 border-b-2">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">

                @if (!Route::currentRouteNamed('profile.show'))
                    <button type="button" x-on:click="$dispatch('open-sidebar')"
                        class="inline-flex items-center p-2 text-sm text-white rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 hover:text-gray-400 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                        <span class="sr-only">Open sidebar</span>
                        <x-icon name="bars-3" class="w-6 h-6 text-slate-700" />
                    </button>
                @endif

                {{-- @include('layouts.partials.logo') --}}

                <a href="" class="flex ms-2 md:me-24" wire:navigate>
                    <h1 class="text-logo-nav">
                        CLINICA APP
                    </h1>
                </a>

            </div>
            <div class="flex items-center">
                <div class="flex items-center ms-3 gap-3">

                    {{-- profile --}}

                    <x-view-profile />

                </div>
            </div>
        </div>
    </div>
</nav>
