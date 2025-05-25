<x-layouts.app :title="__('View')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="relative h-full flex-1 overflow-hidden">
            <livewire:grading-template :gradingFormId="$formId" />
        </div>
    </div>
</x-layouts.app>
