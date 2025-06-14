<div x-data="{ locked:@entangle('isStudentLocked') }"
     class="flex flex-col items-center justify-center min-h-screen bg-gray-50">
    <div class="w-full px-2 py-4">
        <div class="bg-white rounded-lg shadow p-4">
            @if (session()->has('message'))
                <div
                    x-data="{ show: true }"
                    x-init="setTimeout(() => show = false, 3000)"
                    x-show="show"
                    class="fixed top-6 left-1/2 transform -translate-x-1/2 mb-4 px-4 py-2 bg-green-100 border border-green-300 text-green-800 rounded transition-all duration-500 z-50 shadow-lg"
                >
                    {{ session('message') }}
                </div>
            @endif
            @if (session()->has('success'))
                <div
                    x-data="{ show: true }"
                    x-init="setTimeout(() => show = false, 3000)"
                    x-show="show"
                    class="fixed top-6 left-1/2 transform -translate-x-1/2 mb-4 px-4 py-2 bg-green-100 border border-green-300 text-green-800 rounded transition-all duration-500 z-50 shadow-lg"
                >
                    {{ session('success') }}
                </div>
            @endif
            @if (session()->has('error'))
                <div
                    x-data="{ show: true }"
                    x-init="setTimeout(() => show = false, 3000)"
                    x-show="show"
                    class="fixed top-6 left-1/2 transform -translate-x-1/2 mb-4 px-4 py-2 bg-red-100 border border-red-300 text-red-800 rounded transition-all duration-500 z-50 shadow-lg"
                >
                    {{ session('error') }}
                </div>
            @endif

            <div x-show="!locked" x-transition.duration.300ms>
                <div class="flex justify-center">
                    <div class="bg-white rounded shadow p-4 max-w-md w-full">
                        <div class="mb-4">
                            <label for="student" class="block text-sm font-medium text-gray-700">Selecteer een student</label>
                            <select wire:model="studentId" id="student"
                                    class="mt-1 block w-full border-gray-300 rounded">
                                <option value="">-- Kies een student --</option>
                                @foreach ($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button
                            wire:click="lockStudent"
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                            :disabled="!$wire.studentId"
                        >
                            Bevestig Student
                        </button>
                    </div>
                </div>
            </div>

            <div x-show="locked" x-transition.duration.300ms>
                <form wire:submit.prevent="finalize()" wire:poll.5s="pollDrafts">
                    <div class="mb-6">
                        <span class="font-bold">{{ $form['title'] }}</span>
                    </div>

                    <div>
                        @include('livewire.partials.grading-frontpage-template', ['form' => $form, 'students' => $students, 'locked' => $hasApproved, 'grandTotal' => $this->getGrandTotalPoints(), 'maxObtainablePoints' => $this->maxObtainablePoints,
                'minObtainablePoints' => $this->minObtainablePoints, 'teacherApprovals' => $teacherApprovals, 'grade' => $this->pointsToGrade($this->getGrandTotalPoints())])
                    </div>

                    <div class="flex flex-col gap-6 mt-6">
                        @foreach($form['tables'] as $tableIndex => $table)
                            @if(isset($table['criteria_rows']) && count($table['criteria_rows']))
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-bold">{{ $table['title'] ?? 'Geen titel' }}</span>
                                    </div>

                                    <div class="overflow-x-auto">
                                        <table class="table-auto w-full border-collapse border border-gray-300">
                                            <thead>
                                            <tr>
                                                <th colspan="2"
                                                    class="bg-blue-100 text-sm p-2 text-center border border-gray-300">
                                                    Verwachte componenten in deliverables
                                                </th>
                                                <th class="bg-orange-100 text-sm p-2 text-center border border-gray-300">
                                                    Onvoldoende (0 punten)
                                                </th>
                                                <th class="bg-green-200 text-sm p-2 text-center border border-gray-300">
                                                    Voldoende (3 punten)
                                                </th>
                                                <th class="bg-green-300 text-sm p-2 text-center border border-gray-300">
                                                    Goed (5 punten)
                                                </th>
                                                <th class="bg-blue-200 text-sm p-2 text-center border border-gray-300 w-20">
                                                    Punten
                                                </th>
                                                <th class="bg-blue-200 text-sm p-2 text-center border border-gray-300">
                                                    Opmerking
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($table['criteria_rows'] as $rowIndex => $row)
                                                <tr>
                                                    <td class="border border-gray-300 p-2 bg-gray-100">
                                                        <span class="font-bold">{!! $row['component'] !!}</span>
                                                    </td>
                                                    <td class="border border-gray-300 p-2">
                                                        <span>{!! $row['description'] !!}</span>
                                                    </td>
                                                    <td class="border border-gray-300 p-2 cursor-pointer text-center
                                            {{ isset($row['points']) && $row['points'] === 0 ? 'bg-orange-100' : '' }}"
                                                        @if(!$hasApproved)
                                                        wire:click="setPoints({{ $tableIndex }}, {{ $rowIndex }}, 0)"
                                                        @endif
                                                    >
                                                        <span>{{ $row['insufficient'] }}</span>
                                                    </td>
                                                    <td class="border border-gray-300 p-2 cursor-pointer text-center
                                            {{ isset($row['points']) && $row['points'] === 3 ? 'bg-green-200' : '' }}"
                                                        @if(!$hasApproved)
                                                        wire:click="setPoints({{ $tableIndex }}, {{ $rowIndex }}, 3)"
                                                        @endif
                                                    >
                                                        <span>{{ $row['sufficient'] }}</span>
                                                    </td>
                                                    <td class="border border-gray-300 p-2 cursor-pointer text-center
                                            {{ isset($row['points']) && $row['points'] === 5 ? 'bg-green-300' : '' }}"
                                                        @if(!$hasApproved)
                                                        wire:click="setPoints({{ $tableIndex }}, {{ $rowIndex }}, 5)"
                                                        @endif
                                                    >
                                                        <span>{{ $row['good'] }}</span>
                                                    </td>
                                                    <td class="border border-gray-300 p-2 text-center">
                                                        <span>{{ $row['points'] ?? '' }}</span>
                                                    </td>
                                                    <td class="border border-gray-300 p-2">
                                        <textarea
                                            wire:model.debounce.500ms="form.tables.{{ $tableIndex }}.criteria_rows.{{ $rowIndex }}.remarks"
                                            class="w-full border rounded p-1 text-xs resize-y"
                                            rows="2"
                                            placeholder="Opmerking..."
                                            @if($hasApproved) disabled style="background-color: #f3f4f6; color: #888;" @endif></textarea>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="5"
                                                    class="border border-gray-300 p-2 text-right font-semibold">
                                                    Totaal behaalde punten
                                                </td>
                                                <td class="border border-gray-300 p-2 text-center bg-blue-100">
                                    <span class="font-bold">
                                        {{ array_sum(array_column($table['criteria_rows'], 'points')) }}
                                    </span>
                                                </td>
                                                <td class="border border-gray-300 p-2 bg-blue-100">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="border border-gray-300 p-2">
                                                    <span>{!! $table['description_1'] ?? '' !!}</span>
                                                </td>
                                                <td colspan="4" class="border border-gray-300 p-2">
                                                    <div class="flex items-center justify-between mb-3 last:mb-0">
                                                        <span>{{ $table['deliverable_text'] ?? '' }}</span>
                                                        <input type="checkbox"
                                                               wire:model.debounce.500ms="form.tables.{{ $tableIndex }}.deliverable_checked"
                                                               class="h-5 w-5 text-blue-600 rounded border-gray-300"
                                                               @if($hasApproved) disabled style="background-color: #f3f4f6; color: #888;" @endif/>
                                                    </div>
                                                    <hr class="border-black my-3">
                                                    @if(isset($table['knockoutcriteria']))
                                                        @foreach($table['knockoutcriteria'] as $koIndex => $criteria)
                                                            <div
                                                                class="flex items-center justify-between mb-3 last:mb-0">
                                                                <span>{{ $criteria['text'] ?? '' }}</span>
                                                                <input type="checkbox"
                                                                       wire:model.debounce.500ms="form.tables.{{ $tableIndex }}.knockoutcriteria.{{ $koIndex }}.checked"
                                                                       class="h-5 w-5 text-blue-600 rounded border-gray-300"
                                                                       @if($hasApproved) disabled style="background-color: #f3f4f6; color: #888;" @endif/>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" class="border border-gray-300 p-2">
                                                    <span>{!! $table['description_2'] ?? '' !!}</span>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        <div class="mt-4 flex justify-center gap-4">
                            @if(!$hasApproved)
                                <button type="submit"
                                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    Beoordeling goedkeuren
                                </button>
                            @elseif(!$allApproved)
                                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-2 rounded">
                                    U heeft de beoordeling goedgekeurd. Wacht op de andere docent.
                                </div>
                            @else
                                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded">
                                    Alle docenten hebben goedgekeurd. De beoordeling is definitief opgeslagen.
                                </div>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('delayed-redirect', url => {
            setTimeout(() => {
                window.location.href = url;
            }, 2500);
        });
    });
</script>
