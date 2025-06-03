<x-layouts.app :title="__('TEACHER Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative aspect-video overflow-auto rounded-xl border border-neutral-200 dark:border-neutral-700">
                @livewire('dashboard-teacher-subjects')
            </div>
            <div class="relative aspect-video overflow-auto rounded-xl border border-neutral-200 dark:border-neutral-700">
                @livewire('grades-list')
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
        </div>
    </div>

    <div x-data="{ open: false }"
         @click.away="open = false"
         class="fixed bottom-6 right-6 z-50">

        <div class="absolute bottom-16 right-0 mb-2">
            <a href="{{ route('grading-template.index') }}"
               x-show="open"
               x-transition:enter="transition ease-out duration-300 transform"
               x-transition:enter-start="opacity-0 scale-95 translate-y-2"
               x-transition:enter-end="opacity-100 scale-100 translate-y-0"
               x-transition:leave="transition ease-in duration-200 transform"
               x-transition:leave-start="opacity-100 scale-100 translate-y-0"
               x-transition:leave-end="opacity-0 scale-95 translate-y-2"
               class="block bg-blue-600 text-white px-6 py-3 rounded-lg shadow-lg hover:bg-blue-700 hover:shadow-xl transition-all duration-200 whitespace-nowrap font-medium"
            >
                Formulier aanmaken
            </a>
        </div>

        <button
            @click="open = !open"
            class="w-14 h-14 rounded-full bg-blue-600 text-white text-3xl flex items-center justify-center shadow-lg hover:bg-blue-700 hover:shadow-xl transition-all duration-200 transform hover:scale-105"
            :class="{ 'rotate-45': open }"
        >
            +
        </button>
    </div>

</x-layouts.app>
