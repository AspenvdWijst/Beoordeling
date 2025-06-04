<div class="bg-white shadow rounded p-4">
    <h2 class="text-xl font-semibold mb-4 dark:text-black">Zoek niet-goedgekeurde cijfers</h2>

    <!-- Search for Student Name -->
    <div class="flex items-center space-x-4 sticky">
        <input type="text" wire:model.live.debounce.500ms="search" placeholder="Zoek student..."
               class="border p-2 rounded w-full dark:text-black">
    </div>

    <div class="items p-3 mt-4">
            <ul class="mt-2 border rounded p-2 bg-white dark:text-black">
                @foreach($filteredGrades as $grade)
                    <div class="item">
                        <h2>{{ $grade->grade }}</h2>
                        <h2>{{ $grade->student?->name ?? 'Unknown' }}</h2>
                        <h2>{{ $grade->assignment?->assignment_name ?? 'Unknown' }}</h2>

                @if(auth()->user()->role_id === 2)
                        @php
                            $userHasApproved = in_array(auth()->id(), [$grade->teacher1_id, $grade->teacher2_id]);
                            $approvals = $grade->only(['teacher1_id', 'teacher2_id']);
                            $approverCount = collect($approvals)->filter()->count();
                        @endphp

                        @if (!$userHasApproved)
                            <form action="{{ route('grades.approve', $grade->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    Keur goed
                                </button>
                            </form>
                        @endif

                        @if ($approverCount === 2)
                            <form action="{{ route('grades.submit', $grade->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">Submit</button>
                            </form>
                        @elseif ($approverCount > 2)
                            <p class="text-success">Al goedgekeurd!</p>
                        @endif

                        <p>Goedkeuringen: {{ $approverCount }}/2</p>
                        <br>
                @else
                        <form action="{{ route('grades.submit', $grade->id) }}" method="POST">
                            <input type="text" name="newGrade" class="border p-2 rounded dark:text-black" placeholder="Nieuw cijfer" wire:model="newGrade" autocomplete="off">
                            @csrf
                            <button type="submit" class="btn btn-success text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Lever in</button>
                        </form>
                @endif
                    </div>
                @endforeach
            </ul>
    </div>
</div>
