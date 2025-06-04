<div class="bg-white shadow rounded p-4">
    <h2 class="text-xl font-semibold mb-4 dark:text-black">Zoek hier een student</h2>
    <input type="text" wire:model.live.debounce.500ms="search" placeholder="Zoek studenten..."
           class="border p-2 rounded w-full dark:text-black">

    @if($search)
        <ul class="mt-2 border rounded p-2 bg-white">
            @forelse($users as $user)
                <div class="flex justify-between">
                    <strong class="p-2.5 border-b last:border-0 dark:text-black">{{ $user->name }}</strong>
                    <a href="{{ route('add.student.subject', [$subject->id, $user->id] ) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        Voeg student toe
                    </a>
                </div>
            @empty
                <li class="p-1 text-gray-500">Geen student gevonden.</li>
            @endforelse
        </ul>
    @endif
</div>
