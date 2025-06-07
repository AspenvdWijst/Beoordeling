<div class="bg-white shadow rounded p-4">
    <h2 class="text-xl font-semibold mb-4 dark:text-black">Zoek hier een student</h2>
    <input type="text" wire:model.live.debounce.500ms="search" placeholder="Zoek studenten..."
           class="border p-2 rounded w-full dark:text-black">

    @if($search)
        <ul class="mt-2 border rounded p-2 bg-white">
            @forelse($users as $user)
                <div class="flex justify-between">
                    <strong class="p-2.5 border-b last:border-0 dark:text-black">{{ $user->name }}</strong>
                    <a href="{{ route('add.student.subject', [$subject->id, $user->id] ) }}" class="px-6 py-3 mt-2 bg-windesheim text-white rounded-lg shadow-md hover:bg-windesheim-hover focus:outline-none focus:ring-2 focus:ring-windesheim-focus">
                        Voeg student toe
                    </a>
                </div>
            @empty
                <li class="p-1 text-gray-500">Geen student gevonden.</li>
            @endforelse
        </ul>
    @endif
</div>
