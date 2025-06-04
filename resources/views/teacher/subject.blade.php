<x-layouts.app>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-2">
            <div class="relative max-h-200 overflow-auto rounded-xl border border-neutral-200 dark:border-neutral-700">
                @livewire('subject-assignments-overview', ['subjectId' => $subject->id])
            </div>
            <div class="relative max-h-200 overflow-auto rounded-xl border border-neutral-200 dark:border-neutral-700">
                @livewire('add-student-to-subject', ['subjectId' => $subject->id])
            </div>
        </div>
    </div>
</x-layouts.app>
