<div class="bg-white shadow rounded p-4">
    <h2 class="text-xl font-semibold mb-4 dark:text-black">Recent gemaakte docenten accounts</h2>
    <ul>
        @forelse ($recentTeachers as $teacher)
            <li class="border-b py-2 dark:text-black">
                <strong>{{ $teacher->name }}</strong> - {{ $teacher->email }}
                <div class="text-sm text-gray-500">{{ $teacher->created_at->diffForHumans() }}</div>
            </li>
        @empty
            <li>Geen accounts gevonden.</li>
        @endforelse
    </ul>
</div>
