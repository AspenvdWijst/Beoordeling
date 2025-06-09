<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component {
    public string $password = '';

    /**
     * Delete the currently authenticated user.
     */
    public function deleteUser(Logout $logout): void
    {
        $this->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);

        tap(Auth::user(), $logout(...))->delete();

        $this->redirect('/', navigate: true);
    }
}; ?>

<section class="mt-10 space-y-6">
    <div class="relative mb-5">
        <flux:heading>{{ __('Verwijder account') }}</flux:heading>
        <flux:subheading>{{ __('Verwijder uw account en alle data gerelateerd daaraan') }}</flux:subheading>
    </div>

    <flux:modal.trigger name="confirm-user-deletion">
        <flux:button variant="danger" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
            {{ __('Verwijder account') }}
        </flux:button>
    </flux:modal.trigger>

    <flux:modal name="confirm-user-deletion" :show="$errors->isNotEmpty()" focusable class="max-w-lg">
        <form wire:submit="deleteUser" class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Are you sure you want to delete your account?') }}</flux:heading>

                <flux:subheading>
                    {{ __('Als uw account is verwijderd, worden alle gegevens en data permanent verwijderd. Vul uw wachtwoord in om te bevestigen dat u uw account permanent wilt verwijderen.') }}
                </flux:subheading>
            </div>

            <flux:input wire:model="password" :label="__('Wachtwoord')" type="password" />

            <div class="flex justify-end space-x-2 rtl:space-x-reverse">
                <flux:modal.close>
                    <flux:button variant="filled">{{ __('Annuleer') }}</flux:button>
                </flux:modal.close>

                <flux:button variant="danger" type="submit">{{ __('Verwijder account') }}</flux:button>
            </div>
        </form>
    </flux:modal>
</section>
