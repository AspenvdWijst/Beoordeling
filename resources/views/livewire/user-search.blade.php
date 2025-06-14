<div class="bg-white shadow rounded p-4">
    <h2 class="text-xl font-semibold mb-4 dark:text-black">Zoek hier een gebruiker</h2>
    <input type="text" wire:model.live.debounce.500ms="search" placeholder="Zoek gebruikers..."
           class="border p-2 rounded w-full dark:text-black">

    @if($search)
        <ul class="mt-2 border rounded p-2 bg-white">
            @forelse($users as $user)
                <li class="p-2 border-b last:border-0 dark:text-black">{{ $user->name }}
                    <a href="{{route("users.update", $user->id)}}" class="px-4 py-2 mb-3 bg-windesheim text-white rounded-lg shadow-md hover:bg-windesheim-hover focus:outline-none focus:ring-2 focus:ring-windesheim-focus">
                        Bewerk
                    </a>
                </li>
            @empty
                <li class="p-1 text-gray-500">Geen gebruikers gevonden.</li>
            @endforelse
        </ul>
    @endif
    <div class="pt-2">
        <form action="{{ route('users.add') }}" method="POST">
            @csrf
            <button type="submit" class="px-6 py-3 mt-2 bg-windesheim text-white rounded-lg shadow-md hover:bg-windesheim-hover focus:outline-none focus:ring-2 focus:ring-windesheim-focus">
                Maak nieuwe gebruiker
            </button>
        </form>
    </div>
</div>
