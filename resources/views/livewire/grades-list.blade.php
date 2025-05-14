<div class="items p-3">
    @foreach ($grades as $grade)
        <div class="item">
            <h2>{{ $grade->grade }}</h2>
            <h2>{{ $grade->student?->name ?? 'Unknown' }}</h2>
            <h2>{{ $grade->assignment?->assignment_name ?? 'Unknown' }}</h2>

            @php
                $approvals = $grade->approvals; // All approvals for this item
                $userHasApproved = $approvals->contains('user_id', auth()->id());
                $approverCount = $approvals->count();
            @endphp

            {{-- Show Approve button if the user has not approved yet --}}
            @if (!$userHasApproved)
                <form action="{{ route('grades.approve', $grade->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Approve
                    </button>
                </form>
            @endif

            {{-- Show Submit button if there are exactly 2 approvals --}}
            @if ($approverCount === 2)
                <form action="{{ route('grades.submit', $grade->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            @elseif ($approverCount > 2)
                <p class="text-success">Already submitted!</p>
            @endif

            {{-- Display current number of approvals --}}
            <p>Approvals: {{ $approverCount }}/2</p>
            <br>
        </div>
    @endforeach
</div>

