<nav class="navbar top-0 z-50 bg-cyan-600" x-data="{ isNarrow: window.innerWidth <= 640, resize: $persist(false) }" x-on:sidebar-function.window="resize = !resize"
    x-on:resize.window="isNarrow = window.innerWidth <= 640, resize = false"
    :class="{
        'left-[68px] h-[65px]': resize && !isNarrow,
        'left-[250px] h-[80px]': !resize && !isNarrow,
        'left-[0px] h-[75px]': isNarrow
    }">
    <div class="middle-icons px-3 py-3 lg:px-5 lg:pl-3 flex"
        :class="{
            'h-[65px]': resize && !isNarrow,
            'h-[80px]': !resize && !isNarrow,
            'h-[75px]': isNarrow
        }">
        <div class="flex items-center justify-between w-full">
            <div class="flex items-center justify-start rtl:justify-end">

                <div x-data="{ showIcon: window.innerWidth > 640 }" @resize.window="showIcon = window.innerWidth > 640">
                    <x-icon name="bars-3" x-show="showIcon" class="w-6 h-6 text-white cursor-pointer" solid
                        x-on:click="$dispatch('sidebar-function')" />
                    <x-icon name="bars-3" x-show="!showIcon" class="w-6 h-6 text-white cursor-pointer" solid
                        x-on:click="$dispatch('open-sidebar')" x-cloak />
                </div>

            </div>
            <div class="flex items-center">
                <x-view-profile />
            </div>
        </div>
    </div>
</nav>
