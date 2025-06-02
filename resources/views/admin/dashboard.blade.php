<x-layouts.app :title="__('Admin Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                @livewire('dashboard-recent-teachers')
            </div>
            <div class="relative aspect-video overflow-auto rounded-xl border border-neutral-200 dark:border-neutral-700">
                @livewire('dashboard-recent-students')
            </div>
            <div class="relative overflow-auto aspect-video rounded-xl border border-neutral-200 dark:border-neutral-700">
                @livewire('user-search')
            </div>
        </div>
            <div class="relative aspect-video h-full flex-1 overflow-auto rounded-xl border border-neutral-200 dark:text-black dark:border-neutral-700">
                @livewire('grades-list', ['grades' => $grades])
            </div>
    </div>
</x-layouts.app>
