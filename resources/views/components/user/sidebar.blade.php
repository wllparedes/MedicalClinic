<aside id="logo-sidebar" x-data="{ open: window.innerWidth > 640 }" x-on:open-sidebar.window="open = !open"
    x-on:resize.window="open = window.innerWidth > 640" :class="{ 'translate-x-0': open, '-translate-x-full': !open }"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform duration-200 ease-in-out transform bg-sky-700"
    aria-label="Sidebar">
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
            @endcan

        </ul>
    </div>
</aside>
