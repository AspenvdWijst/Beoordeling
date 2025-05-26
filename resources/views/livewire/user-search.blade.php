<div class="bg-white shadow rounded p-4">
    @switch(auth()->user()->role_id)
        @case(3)
            <h2 class="text-xl font-semibold mb-4 dark:text-black">Zoek hier een gebruiker of klas</h2>
            @break
        @case(2)
            <h2 class="text-xl font-semibold mb-4 dark:text-black">Zoek hier een student</h2>
            @break
        @case(1)
            <h2 class="text-xl font-semibold mb-4 dark:text-black">Zoek hier je resultaten</h2>
            @break
        @default
            <h2 class="text-xl font-semibold mb-4 dark:text-black">Zoeken</h2>
    @endswitch
    <input type="text" wire:model.live.debounce.500ms="search" placeholder="Search users..."
           class="border p-2 rounded w-full dark:text-black">

    @if($search)
        <ul class="mt-2 border rounded p-2 bg-white">
            @forelse($users as $user)
                <li class="p-1 border-b last:border-0 dark:text-black"><a href="{{route("users.update", $user->id)}}">{{ $user->name }}</a></li>
            @empty
                <li class="p-1 text-gray-500">No users found.</li>
            @endforelse
        </ul>
    @endif
    <div class="pt-2">
        <form action="{{ route('users.add') }}" method="POST">
            @csrf
            <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Add new user
            </button>
        </form>
    </div>
</div>
