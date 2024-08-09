<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Personal - Clinica</title>

    <!-- Fonts -->
    {{-- <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> --}}

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

    <!-- WireUI -->
    <wireui:scripts />

</head>

<body class="font-sans antialiased bg-gray-50">

    <x-dialog />

    <x-notifications />

    <x-user.sidebar />

    <livewire:navigation-menu />

    <!-- Page Content -->
    <main class="main-content bg-gray-50" x-data="{ isNarrow: window.innerWidth <= 640, resize: $persist(false) }" x-on:sidebar-function.window="resize = !resize"
        x-on:resize.window="isNarrow = window.innerWidth <= 640, resize = false"
        :class="{
            'pl-[90px]': resize && !isNarrow,
            'pl-[288px]': !resize && !isNarrow,
            'pl-[5px] pr-[5px]': isNarrow,
            'pr-[30px]': !isNarrow
        }">
        {{ $slot }}
    </main>

    <x-footer />

    @stack('modals')

    @livewireScripts
</body>

</html>
