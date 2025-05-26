<div class="flex flex-col items-center justify-center min-h-screen">
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif

    <form wire:submit.prevent="finalize()" wire:poll.10s="pollDrafts">
        <div class="mb-6">
            <span class="font-bold">{{ $form['title'] }}</span>
        </div>

        <div>
            @include('livewire.partials.grading-frontpage-template', ['form' => $form, 'grandTotal' => $this->getGrandTotalPoints(), 'maxObtainablePoints' => $this->maxObtainablePoints,
    'minObtainablePoints' => $this->minObtainablePoints,])
        </div>

        <div class="flex flex-col gap-4 mt-6">
            @foreach($form['tables'] as $tableIndex => $table)
                @if(isset($table['criteria_rows']) && count($table['criteria_rows']))
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-bold">{{ $table['title'] ?? 'Geen titel' }}</span>
                        </div>

                        <table class="table-auto w-full border-collapse border border-gray-300">
                            <thead>
                            <tr>
                                <th colspan="2" class="bg-blue-100 text-sm p-2 text-center border border-gray-300">
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
                                        wire:click="setPoints({{ $tableIndex }}, {{ $rowIndex }}, 0)"
                                    >
                                        <span>{{ $row['insufficient'] }}</span>
                                    </td>
                                    <td class="border border-gray-300 p-2 cursor-pointer text-center
                                            {{ isset($row['points']) && $row['points'] === 3 ? 'bg-green-200' : '' }}"
                                        wire:click="setPoints({{ $tableIndex }}, {{ $rowIndex }}, 3)"
                                    >
                                        <span>{{ $row['sufficient'] }}</span>
                                    </td>
                                    <td class="border border-gray-300 p-2 cursor-pointer text-center
                                            {{ isset($row['points']) && $row['points'] === 5 ? 'bg-green-300' : '' }}"
                                        wire:click="setPoints({{ $tableIndex }}, {{ $rowIndex }}, 5)"
                                    >
                                        <span>{{ $row['good'] }}</span>
                                    </td>
                                    <td class="border border-gray-300 p-2 text-center">
                                        <span>{{ $row['points'] ?? '' }}</span>
                                    </td>
                                    <td class="border border-gray-300 p-2">
                                        <textarea
                                            wire:model.debounce.1000ms="form.tables.{{ $tableIndex }}.criteria_rows.{{ $rowIndex }}.remarks"
                                            class="w-full border rounded p-1 text-xs resize-y"
                                            rows="2"
                                            placeholder="Opmerking..."></textarea>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="5" class="border border-gray-300 p-2 text-right font-semibold">
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
                                    <span>{{ $table['description_1'] ?? '' }}</span>
                                </td>
                                <td colspan="4" class="border border-gray-300 p-2">
                                    <div class="flex items-center justify-between mb-3 last:mb-0">
                                        <span>{{ $table['deliverable_text'] ?? '' }}</span>
                                        <span>
                                            @if(!empty($table['deliverable_checked']))
                                                &#10003;
                                            @else
                                                &#10007;
                                            @endif
                                        </span>
                                        <input type="checkbox"
                                               wire:model.debounce.1000ms="form.tables.{{ $tableIndex }}.deliverable_checked"
                                               class="h-5 w-5 text-blue-600 rounded border-gray-300">
                                    </div>
                                    <hr class="border-black my-3">
                                    @if(isset($table['knockoutcriteria']))
                                        @foreach($table['knockoutcriteria'] as $koIndex => $criteria)
                                            <div class="flex items-center justify-between mb-3 last:mb-0">
                                                <span>{{ $criteria['text'] ?? '' }}</span>
                                                <span>
                                                    @if(!empty($criteria['checked']))
                                                        &#10003;
                                                    @else
                                                        &#10007;
                                                    @endif
                                                </span>
                                                <input type="checkbox"
                                                       wire:model.debounce.1000ms="form.tables.{{ $tableIndex }}.knockoutcriteria.{{ $koIndex }}.checked"
                                                       class="h-5 w-5 text-blue-600 rounded border-gray-300">
                                            </div>
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7" class="border border-gray-300 p-2">
                                    <span>{{ $table['description_2'] ?? '' }}</span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                @endif
            @endforeach
            <div class="mt-4 flex justify-center gap-4">
                <button type="button"
                        wire:click="saveDraft()"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Concept opslaan
                </button>
                <button type="submit"
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Opslaan
                </button>
            </div>
        </div>
    </form>
</div>
