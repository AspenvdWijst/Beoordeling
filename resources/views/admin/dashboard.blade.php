<x-layouts.app :title="__('ADMIN Dashboard')">
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
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <div class="sticky top-0 z-10 bg-white dark:bg-neutral-900 p-4">
                @livewire('grades-search')
            </div>
            @livewire('grades-list', ['grades' => $grades])
        </div>
    </div>
</x-layouts.app>
