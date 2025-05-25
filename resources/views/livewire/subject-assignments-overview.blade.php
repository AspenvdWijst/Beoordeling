<div class="bg-white shadow rounded p-4 dark:text-black">
    <h2 class="text-lg font-semibold mb-2">{{ $subject->subject_name }}</h2>
{{--    @dd($subject->assignments)--}}
    @if ($subject->assignments->isNotEmpty())
        <ul class="list-disc list-inside text-gray-700">
            @if(auth()->user()->role_id == 2)
                <div class="py-3">
                    <a href="{{ route('new.assignment', [$subject->id] ) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        Make Assignment
                    </a>
                </div>
            @endif
            @foreach ($subject->assignments as $assignment)
                <div class="py-3">
                    <strong>{{ $assignment->assignment_name }}</strong>
                    @if(auth()->user()->role_id == 2)
                        <a href="{{ route('teacher.assignment', [$subject->id, $assignment->id] ) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            Edit Assignment
                        </a>
                    @endif
                </div>
            @endforeach
        </ul>
    @else
        <p class="text-sm text-gray-500">No assignments found for this subject.</p>
    @endif
</div>
