<div>
    <input type="text" wire:model.live.debounce.500ms="search" placeholder="Search users..." class="border p-2 rounded w-full">

    @if($search)
        <ul class="mt-2 border rounded p-2 bg-white">
            @forelse($users as $user)
                <li class="p-1 border-b last:border-0">{{ $user->email }}</li>
            @empty
                <li class="p-1 text-gray-500">No users found.</li>
            @endforelse
        </ul>
    @endif
</div>
