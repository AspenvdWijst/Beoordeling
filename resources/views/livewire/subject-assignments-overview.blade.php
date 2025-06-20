<div class="p-4">
    <h2 class="text-lg font-semibold mb-2">{{ $subject->subject_name }}</h2>
{{--    @dd($subject->assignments)--}}
    @if ($subject->assignments->isNotEmpty())
        <ul class="list-disc list-inside text-gray-700">
            @if(auth()->user()->role_id == 2)
                <div class="py-3">
                    <a href="{{ route('new.assignment', [$subject->id] ) }}" class="px-6 py-3 mt-2 bg-windesheim text-white rounded-lg shadow-md hover:bg-windesheim-hover focus:outline-none focus:ring-2 focus:ring-windesheim-focus">
                        Maak opdracht
                    </a>
                </div>
            @endif
            @foreach ($subject->assignments as $assignment)
                <div class="py-3">
                    <strong>{{ $assignment->assignment_name }}</strong>
                    @if(auth()->user()->role_id == 2)
                        <a href="{{ route('teacher.assignment', [$subject->id, $assignment->id] ) }}" class="px-6 py-3 mt-2 bg-windesheim text-white rounded-lg shadow-md hover:bg-windesheim-hover focus:outline-none focus:ring-2 focus:ring-windesheim-focus">
                            Bewerk opdracht
                        </a>
                    @endif
                </div>
            @endforeach
        </ul>
    @else
        <p class="text-sm text-gray-500">Geen opdrachten gevonden voor dit vak.</p>
    @endif
</div>
