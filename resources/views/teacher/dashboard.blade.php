<x-layouts.app :title="__('Dashboard dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-2">
            <div class="relative max-h-150 overflow-auto rounded-xl border border-neutral-200 dark:border-neutral-700">
                @livewire('dashboard-teacher-subjects')
            </div>
            <div class="relative max-h-150 overflow-auto rounded-xl border border-neutral-200 dark:border-neutral-700">
                @livewire('grades-list')
            </div>
        </div>
    </div>
</x-layouts.app>
