<aside id="logo-sidebar" x-data="{ minOpen: $persist(false), open: window.innerWidth > 640 }" x-on:sidebar-function.window="minOpen = !minOpen"
    x-on:open-sidebar.window="open = !open" x-on:resize.window="open = window.innerWidth > 640, minOpen = false"
    :class="{
        'w-[70px]': minOpen,
        'w-[250px]': !minOpen,
        'z-70': open && window.innerWidth <= 640,
        'z-10': !open || window.innerWidth > 640
    }"
    x-on:click.away="if (window.innerWidth <= 640) { open = false; $dispatch('hidden-blak'); }"
    class="fixed top-0 left-0  transition-transform duration-200 ease-in-out transform bg-cyan-600" aria-label="Sidebar"
    x-show="open" x-transition:enter="transition ease-in duration-300"
    x-transition:enter-start="opacity-0 -translate-x-full" x-transition:enter-end="opacity-100 translate-x-0"
    x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-x-0"
    x-transition:leave-end="opacity-0 -translate-x-full">


    <div class="sidebar-home p-4 bg-white mb-4">
        <a href="">
            <img src="{{ asset('images/clinic/adp.png') }}" alt="" class="w-[75%]">
        </a>
    </div>


    <div class="h-full px-3 pb-4 overflow-y-auto dark:bg-gray-800">
        <ul class="space-y-2 font-medium">

            @can('allowAdmin')
                <x-sidebar-link route="admin.dashboard" icon="home" label="Home" />
                <x-sidebar-link route="admin.staff" icon="users" label="Personal" />
                <x-sidebar-link route="admin.patients" icon="user-group" label="Pacientes" />
                <x-sidebar-link route="admin.categories" icon="bookmark" label="Categorias" />
                <x-sidebar-link route="admin.products" icon="beaker" label="Productos" />
            @endcan

            @can('allowReceptionist')
                <x-sidebar-link route="receptionist.dashboard" icon="home" label="Home" />
                <x-sidebar-link route="receptionist.patients" icon="users" label="Pacientes" />
                <x-sidebar-link route="receptionist.doctors" icon="user-group" label="Doctores" />
                <x-sidebar-link route="receptionist.appointments" icon="calendar" label="Citas médicas" />
            @endcan

            @can('allowDoctor')
                <x-sidebar-link route="doctor.dashboard" icon="home" label="Home" />
                <x-sidebar-link route="doctor.appointments" icon="calendar" label="Citas médicas" />
                <x-sidebar-link route="doctor.patients" icon="users" label="Pacientes" />
                <x-sidebar-link route="doctor.chats" icon="user-group" label="Chat" />
            @endcan

        </ul>
    </div>
</aside>
<div x-data="{ gray: false }" x-on:open-sidebar.window="gray = true" x-show="gray"
    x-on:hidden-blak.window="gray = !gray" x-on:resize.window="gray = false" x-cloak x-transition.opacity
    class="fixed inset-0 bg-black bg-opacity-50 z-60">
</div>
