<div class="p-4">
    <h2 class="text-xl font-semibold mb-4 dark:text-black">Jouw vakken</h2>
    <ul>
        @forelse($subjects as $subject)
            <li class="border-b py-2 dark:text-black">
                <a class="cursor-pointer" href="{{ route('student.subject', $subject->id ) }}"><strong>{{ $subject->subject_name }}</strong></a>
            </li>
        @empty
            <li class="dark:text-black">Geen vakken gevonden.</li>
        @endforelse
    </ul>
</div>

