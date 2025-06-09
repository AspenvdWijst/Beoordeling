<x-layouts.app>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-1">
            <div class="relative aspect-video overflow-auto rounded-xl border border-neutral-200 dark:border-neutral-700">
                @livewire('update-assignment', ['assignmentId' => $assignment->id, 'subjectId' => $subject->id])
            </div>
        </div>
    </div>
</x-layouts.app>
