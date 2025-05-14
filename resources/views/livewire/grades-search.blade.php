<div class="bg-white shadow rounded p-4">
    <h2 class="text-xl font-semibold mb-4 dark:text-black">Search Unapproved Grades</h2>

    <!-- Dropdown for selecting search type -->
    <div class="flex items-center space-x-4">
        <select wire:model="searchType" class="border p-2 rounded dark:text-black">
            <option value="student">Search by Student Name</option>
            <option value="assignment">Search by Assignment Name</option>
        </select>

        <!-- Search Input, bound to $search -->
        <input type="text" wire:model.debounce.500ms="search" placeholder="Search..."
               class="border p-2 rounded w-full dark:text-black">
    </div>

    @if($search)  <!-- Only show results if there is something in the search field -->
    <ul class="mt-2 border rounded p-2 bg-white">
        @forelse($grades as $grade)
            <li class="p-1 border-b last:border-0 dark:text-black">
                <strong>{{ $grade->grade }}</strong> - {{ $grade->student?->name ?? 'Unknown' }} -
                {{ $grade->assignment?->assignment_name ?? 'Unknown' }}
            </li>
        @empty
            <li class="p-1 text-gray-500">No grades found.</li>
        @endforelse
    </ul>
    @endif
</div>
