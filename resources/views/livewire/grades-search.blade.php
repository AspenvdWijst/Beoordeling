<div class="bg-white shadow rounded p-4">
    <h2 class="text-xl font-semibold mb-4 dark:text-black">Search Unapproved Grades</h2>

    <div class="flex items-center space-x-4">
        <!-- Dropdown for selecting search type -->
        <select wire:model="searchType" class="border p-2 rounded dark:text-black">
            <option value="student">Search by Student Name</option>
            <option value="assignment">Search by Assignment Name</option>
        </select>

        <!-- Search Input, bound to $search -->
        <input type="text" wire:model.debounce.500ms="search" placeholder="Search..."
               class="border p-2 rounded w-full dark:text-black">
    </div>
</div>
