<div class="bg-white shadow rounded p-4">
    <h2 class="text-xl font-semibold mb-4">Recent gemaakte studenten accounts</h2>
    <ul>
        @forelse ($recentStudents as $students)
            <li class="border-b py-2">
                <strong>{{ $students->name }}</strong> - {{ $students->email }}
                <div class="text-sm text-gray-500">{{ $students->created_at->diffForHumans() }}</div>
            </li>
        @empty
            <li>Geen accounts gevonden.</li>
        @endforelse
    </ul>
</div>
