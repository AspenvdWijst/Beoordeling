<div class="bg-white shadow rounded p-4">
    <h2 class="text-xl font-semibold mb-4 dark:text-black">Alle cijfers</h2>
    <ul>
        @forelse($grades as $grade)
            <li class="border-b py-2 dark:text-black">
                <strong>{{ $grade->grade }}</strong>
{{--                <strong>{{ $grade-> }}</strong>--}}
            </li>
        @empty
            <li class="dark:text-black">Geen cijfers gevonden.</li>
        @endforelse
    </ul>
</div>

