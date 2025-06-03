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
            <div class="relative aspect-video h-full flex-1 overflow-auto rounded-xl border border-neutral-200 dark:text-black dark:border-neutral-700">
                @livewire('grades-list', ['grades' => $grades])
            </div>
    </div>

    <div x-data="{ open: false }"
         @click.away="open = false"
         class="fixed bottom-6 right-6 z-50">

        <div class="absolute bottom-16 right-0 mb-2">
            <a href="{{ route('grading-form.create') }}"
               x-show="open"
               x-transition:enter="transition ease-out duration-300 transform"
               x-transition:enter-start="opacity-0 scale-95 translate-y-2"
               x-transition:enter-end="opacity-100 scale-100 translate-y-0"
               x-transition:leave="transition ease-in duration-200 transform"
               x-transition:leave-start="opacity-100 scale-100 translate-y-0"
               x-transition:leave-end="opacity-0 scale-95 translate-y-2"
               class="block bg-blue-600 text-white px-6 py-3 rounded-lg shadow-lg hover:bg-blue-700 hover:shadow-xl transition-all duration-200 whitespace-nowrap font-medium"
            >
                Template aanmaken
            </a>
        </div>
        <div class="absolute bottom-32 right-0 mb-2">
            <a href="{{ route('grading-form.edit') }}"
               x-show="open"
               x-transition:enter="transition ease-out duration-300 transform"
               x-transition:enter-start="opacity-0 scale-95 translate-y-2"
               x-transition:enter-end="opacity-100 scale-100 translate-y-0"
               x-transition:leave="transition ease-in duration-200 transform"
               x-transition:leave-start="opacity-100 scale-100 translate-y-0"
               x-transition:leave-end="opacity-0 scale-95 translate-y-2"
               class="block bg-blue-600 text-white px-6 py-3 rounded-lg shadow-lg hover:bg-blue-700 hover:shadow-xl transition-all duration-200 whitespace-nowrap font-medium"
            >
                Template aanpassen
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
