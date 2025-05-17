<div class="bg-white shadow rounded p-4">
    <h2 class="text-xl font-semibold mb-4 dark:text-black">Search Unapproved Grades</h2>

    <!-- Search for Student Name -->
    <div class="flex items-center space-x-4 sticky">
        <input type="text" wire:model.live.debounce.500ms="search" placeholder="Search users..."
               class="border p-2 rounded w-full dark:text-black">
    </div>

    <div class="items p-3 mt-4">
        @if($search)
            @dd($grades)
            <ul class="mt-2 border rounded p-2 bg-white dark:text-black">
                @foreach($grades as $grade)
                    <div class="item">
                        <h2>{{ $grade->grade }}</h2>
                        <h2>{{ $grade->student?->name ?? 'Unknown' }}</h2>
                        <h2>{{ $grade->assignment?->assignment_name ?? 'Unknown' }}</h2>

                        @php
                            $userHasApproved = in_array(auth()->id(), [$grade->teacher1_id, $grade->teacher2_id]);
                            $approvals = $grade->only(['teacher1_id', 'teacher2_id']);
                            $approverCount = collect($approvals)->filter()->count();
                        @endphp

                        @if (!$userHasApproved)
                            <form action="{{ route('grades.approve', $grade->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    Approve
                                </button>
                            </form>
                        @endif

                        @if ($approverCount === 2)
                            <form action="{{ route('grades.submit', $grade->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">Submit</button>
                            </form>
                        @elseif ($approverCount > 2)
                            <p class="text-success">Already submitted!</p>
                        @endif

                        <p>Approvals: {{ $approverCount }}/2</p>
                        <br>
                    </div>
                @endforeach
            </ul>
        @else
            @foreach ($grades as $grade)
                <div class="item">
                    <h2>{{ $grade->grade }}</h2>
                    <h2>{{ $grade->student?->name ?? 'Unknown' }}</h2>
                    <h2>{{ $grade->assignment?->assignment_name ?? 'Unknown' }}</h2>

                    @php
                        $userHasApproved = in_array(auth()->id(), [$grade->teacher1_id, $grade->teacher2_id]);
                        $approvals = $grade->only(['teacher1_id', 'teacher2_id']);
                        $approverCount = collect($approvals)->filter()->count();
                    @endphp

                    @if (!$userHasApproved)
                        <form action="{{ route('grades.approve', $grade->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                Approve
                            </button>
                        </form>
                    @endif

                    @if ($approverCount === 2)
                        <form action="{{ route('grades.submit', $grade->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    @elseif ($approverCount > 2)
                        <p class="text-success">Already submitted!</p>
                    @endif

                    <p>Approvals: {{ $approverCount }}/2</p>
                    <br>
                </div>
            @endforeach
        @endif

    </div>
</div>
