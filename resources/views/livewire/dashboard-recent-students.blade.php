<div class="bg-white shadow rounded p-4 overflow-auto">
    <h2 class="text-xl font-semibold mb-4 dark:text-black">Recent gemaakte studenten accounts</h2>
    <ul>
        @forelse ($recentStudents as $students)
            <li class="border-b py-2">
                <strong class="dark:text-black">{{ $students->name }}</strong><span class="dark:text-black">- {{ $students->email }}</span>
                <div class="text-sm text-gray-500 dark:text-black">{{ $students->created_at->locale('nl')->diffForHumans() }}</div>
            </li>
        @empty
            <li>Geen accounts gevonden.</li>
        @endforelse
    </ul>
</div>
