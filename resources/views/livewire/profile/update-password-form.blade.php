<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

use function Livewire\Volt\rules;
use function Livewire\Volt\state;

state([
    'current_password' => '',
    'password' => '',
    'password_confirmation' => '',
]);

rules([
    'current_password' => ['required', 'string', 'current_password'],
    'password' => ['required', 'string', Password::defaults(), 'confirmed'],
])->messages([
    'current_password.required' => 'Mohon mengisi password Anda yang sekarang.',
    'current_password.current_password' => 'Password yang Anda isi salah.',
    'password' => 'Password Anda harus minimal 8 karakter.',
    'password.required' => 'Mohon mengisi password Anda yang baru.',
    'password.confirmed' => 'Password baru yang diisi belum sama.',
]);

$updatePassword = function () {
    try {
        $validated = $this->validate();
    } catch (ValidationException $e) {
        $this->reset('current_password', 'password', 'password_confirmation');

        throw $e;
    }

    Auth::user()->update([
        'password' => Hash::make($validated['password']),
    ]);

    $this->reset('current_password', 'password', 'password_confirmation');

    $this->dispatch('password-updated');
};

?>

<section>
    <header>
        <h2 class="text-lg font-medium">
            {{ __('Ganti Password') }}
        </h2>

        <p class="mt-1 text-sm text-[rgb(var(--gray-rgb))]">
            {{ __('Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.') }}
        </p>
    </header>

    <form wire:submit="updatePassword" class="mt-6 space-y-6">
        <div>
            <x-input-label for="current_password" :value="__('Password Sekarang')" />
            <x-text-input wire:model="current_password" id="current_password" name="current_password" type="password"
                class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password Baru')" />
            <x-text-input wire:model="password" id="password" name="password" type="password" class="mt-1 block w-full"
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
            <x-text-input wire:model="password_confirmation" id="password_confirmation" name="password_confirmation"
                type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-secondary-button type="submit">{{ __('Ganti') }}</x-secondary-button>

            <x-action-message class="me-3" on="password-updated">
                {{ __('Password berhasil diganti.') }}
            </x-action-message>
        </div>
    </form>
</section>
