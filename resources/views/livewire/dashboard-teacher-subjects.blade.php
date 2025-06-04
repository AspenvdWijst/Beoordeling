<div class="bg-white shadow rounded p-4">
    <input type="text" wire:model.live.debounce.500ms="search" placeholder="Zoek vakken..."
           class="border p-2 rounded w-full dark:text-black">

    <div class="items p-3 mt-4">
        <ul class="mt-2 border rounded p-2 bg-white dark:text-black">
            @foreach($filteredSubjects as $subject)
                <div class="item">
                    <a href="{{ route('teacher.subject', $subject->id ) }}" class="cursor-pointer">
                        <h2>{{ $subject->subject_name }}</h2>
                    </a>
                    <br>
                </div>
            @endforeach
        </ul>
    </div>
</div>
