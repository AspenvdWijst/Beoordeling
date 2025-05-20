<div class="bg-white shadow rounded p-4 dark:text-black">
    <h2 class="text-lg font-semibold mb-2">{{ $subject->subject_name }}</h2>
{{--    @dd($subject->assignments)--}}
    @if ($subject->assignments->isNotEmpty())
        <ul class="list-disc list-inside text-gray-700">
            @foreach ($subject->assignments as $assignment)
                <div>
                    <strong>{{ $assignment->assignment_name }}</strong>
                </div>
            @endforeach
        </ul>
    @else
        <p class="text-sm text-gray-500">No assignments found for this subject.</p>
    @endif
</div>
