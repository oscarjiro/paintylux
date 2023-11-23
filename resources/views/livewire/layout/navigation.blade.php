<?php

use App\Livewire\Actions\Logout;

$logout = function (Logout $logout) {
    $logout();

    $this->redirect('/', navigate: true);
};

?>

<nav id="navbar" x-data="{ open: false }"
    class="h-[var(--navbar-height) smooth fixed left-0 top-0 z-[2] w-screen backdrop-blur-md">
    <!-- Primary Navigation Menu -->
    <div class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 w-full justify-between">
            <div class="flex w-full justify-between">
                <!-- Logo -->
                <div class="flex shrink-0 items-center">
                    <a href="{{ route('index') }}" wire:navigate class="flex items-center space-x-3">
                        <x-application-logo id="navlogo" class="block fill-current" />
                        @auth
                            @if (auth()->user()->is_admin)
                                <div class="text-inactive text-upperwide text-sm">Admin</div>
                            @endif
                        @endauth
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 min-[850px]:-my-px min-[850px]:ms-10 min-[850px]:flex">
                    <x-nav-link :href="route('products')" :active="request()->routeIs('products')" wire:navigate>
                        {{ __('Produk') }}
                    </x-nav-link>
                    <x-nav-link :href="route('projects')" :active="request()->routeIs('projects')" wire:navigate>
                        {{ __('Proyek') }}
                    </x-nav-link>
                    <x-nav-link :href="route('contact')" :active="request()->routeIs('contact')" wire:navigate>
                        {{ __('Kontak') }}
                    </x-nav-link>
                    @auth
                        <x-nav-link :href="route('checkout')" :active="request()->routeIs('checkout')" class="group relative" wire:navigate>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>
                            <div
                                class="@if (request()->routeIs('checkout')) bg-[rgb(var(--acc-rgb))] @else bg-[rgb(var(--gray-rgb))] group-hover:bg-[rgb(var(--fg-rgb))] @endif smooth absolute bottom-[15px] left-[18px] flex h-[15px] w-[15px] items-center justify-center rounded-full text-[8px] tracking-tighter text-[rgb(var(--bg-rgb))]">
                                0</div>
                        </x-nav-link>
                    @endauth
                    @if (!Auth::check())
                        <x-nav-link :href="route('login')" :active="request()->routeIs('login')" wire:navigate>
                            {{ __('Masuk') }}
                        </x-nav-link>
                        <x-nav-link :href="route('register')" :active="request()->routeIs('register')" wire:navigate>
                            {{ __('Daftar') }}
                        </x-nav-link>
                    @endif
                    <!-- Settings Dropdown -->
                    @auth
                        <div class="hidden min-[850px]:ms-6 min-[850px]:flex min-[850px]:items-center">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button
                                        class="inline-flex items-center rounded-md border border-transparent bg-[rgb(var(--fg-rgb))] px-3 py-2 text-sm font-medium leading-4 text-[rgb(var(--bg-rgb))] transition duration-150 ease-in-out hover:text-[rgba(var(--bg-rgb),0.85)] focus:outline-none">
                                        <div x-data="{ name: '{{ auth()->user()->name }}' }" x-text="name"
                                            x-on:profile-updated.window="name = $event.detail.name"></div>

                                        <div class="ms-1">
                                            <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('profile')" wire:navigate>
                                        {{ __('Profile') }}
                                    </x-dropdown-link>

                                    <!-- Authentication -->
                                    <button wire:click="logout" class="w-full text-start">
                                        <x-dropdown-link>
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </button>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    @endauth
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center min-[850px]:hidden">
                <button @click="open = ! open" id="hamburger"
                    class="smooth inline-flex items-center justify-center rounded-md p-2 text-[rgba(var(--fg-rgb),0.7)] hover:text-[rgb(var(--fg-rgb))] focus:text-[rgba(var(--fg-rgb),0.7)] focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden min-[850px]:hidden">
        <div class="space-y-1 pb-3 pt-2">
            <x-responsive-nav-link :href="route('products')" :active="request()->routeIs('products')" wire:navigate>
                {{ __('Produk') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('projects')" :active="request()->routeIs('projects')" wire:navigate>
                {{ __('Proyek') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('contact')" :active="request()->routeIs('contact')" wire:navigate>
                {{ __('Kontak') }}
            </x-responsive-nav-link>
            @if (!Auth::check())
                <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')" wire:navigate>
                    {{ __('Masuk') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('register')" wire:navigate>
                    {{ __('Daftar') }}
                </x-responsive-nav-link>
            @endif
        </div>

        @auth
            <!-- Responsive Settings Options -->
            <div class="navlink smooth border-t border-gray-200 pb-1 pt-4">
                <div class="px-4">
                    <div class="text-base font-medium" x-data="{ name: '{{ auth()->user()->name }}' }" x-text="name"
                        x-on:profile-updated.window="name = $event.detail.name"></div>
                    <div class="text-sm font-medium opacity-60">{{ auth()->user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile')" wire:navigate>
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <button wire:click="logout" class="w-full text-start">
                        <x-responsive-nav-link>
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </button>
                </div>
            </div>
        @endauth
    </div>
</nav>
