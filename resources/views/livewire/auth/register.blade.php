<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'regex:/^[a-zA-Z0-9._%+-]+@windesheim\.nl$/', 'unique:' . User::class],
            'password' => ['required', 'string', 'min:12', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        $this->redirectIntended(route('verification.notice'));
    }
}; ?>

<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Maak een account')" :description="__('Voer uw gegevens hieronder in om een account aan te maken.')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="register" class="flex flex-col gap-6">
        <!-- Name -->
        <flux:input
            wire:model="name"
            :label="__('Naam')"
            type="text"
            required
            autofocus
            autocomplete="name"
            :placeholder="__('Voor- en achternaam')"
        />

        <!-- Email Address -->
        <flux:input
            wire:model="email"
            :label="__('Email adres')"
            type="email"
            required
            autocomplete="email"
            placeholder="email@windesheim.nl"
        />

        <!-- Password -->
        <flux:input
            wire:model="password"
            :label="__('Wachtwoord')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Wachtwoord')"
            viewable
        />

        <!-- Confirm Password -->
        <flux:input
            wire:model="password_confirmation"
            :label="__('Bevestig wachtwoord')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Bevestig wachtwoord')"
            viewable
        />

        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full">
                {{ __('Maak account') }}
            </flux:button>
        </div>
    </form>

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
        {{ __('Heeft u al een account?') }}
        <flux:link :href="route('login')" wire:navigate>{{ __('Log in') }}</flux:link>
    </div>
</div>
