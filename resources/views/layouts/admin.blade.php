<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('assets/favicon.png') }}">

    <title>{{ config('app.name') }} Admin</title>

    <!-- Scripts -->
    @vite(['resources/css/admin.css', 'resources/css/hamburger.css', 'resources/js/app.js'])
</head>

<body class="relative antialiased">
    <livewire:layout.admin-navigation />

    <!-- Page Content -->
    <main class="mt-[var(--navbar-height)] py-4" x-cloak x-data="{ show: false, showPage() { setTimeout(() => this.show = true, 100) } }" x-transition.1500ms x-show="show"
        x-init="showPage">
        {{ $slot }}
    </main>
</body>

</html>
