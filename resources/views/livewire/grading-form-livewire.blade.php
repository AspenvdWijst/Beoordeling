<div wire:poll.5s>
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif

    <form wire:submit.prevent="save">
        <div class="mb-6">
            <label class="block font-bold mb-2">Titel formulier</label>
            <input type="text" wire:model="formTitle" class="w-full border p-2 rounded"
                   placeholder="Voer hier de titel van het formulier in">
        </div>

        <div>
            @include('livewire.partials.grading-frontpage', ['tables' => $tables, 'grandTotal' => $this->getGrandTotalPoints(), 'maxObtainablePoints' => $this->maxObtainablePoints,
    'minObtainablePoints' => $this->minObtainablePoints,])
        </div>

        <button type="button" wire:click="addTable" class="mb-4 px-4 py-2 bg-blue-500 text-white rounded">
            Tabel toevoegen
        </button>
        <div class="flex flex-col gap-4">
            @foreach($tables as $tableIndex => $table)
                @if(isset($table['rows']) && is_array($table['rows']))
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <input type="text"
                                   wire:model="tables.{{ $tableIndex }}.title"
                                   class="flex-1 p-2 text-lg border border-gray-300 font-bold bg-blue-50"
                                   placeholder="Voer competentie analyse titel in...">
                            <button type="button"
                                    wire:click="removeTable({{ $tableIndex }})"
                                    class="ml-4 px-3 py-1 bg-red-100 text-red-600 rounded hover:bg-red-200 transition">
                                Tabel verwijderen
                            </button>
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
                            @foreach($table['rows'] as $rowIndex => $row)
                                <tr>
                                    <td class="border border-gray-300 p-2 bg-gray-100">
                                        <input type="text"
                                               wire:model="tables.{{ $tableIndex }}.rows.{{ $rowIndex }}.component"
                                               class="w-full p-1 text-sm border border-gray-300 rounded"
                                               placeholder="Voer component in...">
                                        @error("tables.{{ $tableIndex }}.rows.{{ $rowIndex }}.component")
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                        @enderror
                                    </td>
                                    <td class="border border-gray-300 p-2">
                                    <textarea wire:model="tables.{{ $tableIndex }}.rows.{{ $rowIndex }}.description"
                                              class="w-full p-1 text-sm border border-gray-300 rounded resize-none"
                                              rows="3"
                                              placeholder="Voer beschrijving in..."></textarea>
                                    </td>
                                    <td class="border border-gray-300 p-2">
                                    <textarea wire:model="tables.{{ $tableIndex }}.rows.{{ $rowIndex }}.insufficient"
                                              class="w-full p-1 text-sm border border-gray-300 rounded resize-none"
                                              rows="3"
                                              placeholder="Voer onvoldoende criteria in..."></textarea>
                                    </td>
                                    <td class="border border-gray-300 p-2">
                                    <textarea wire:model="tables.{{ $tableIndex }}.rows.{{ $rowIndex }}.sufficient"
                                              class="w-full p-1 text-sm border border-gray-300 rounded resize-none"
                                              rows="3"
                                              placeholder="Voer voldoende criteria in..."></textarea>
                                    </td>
                                    <td class="border border-gray-300 p-2">
                                    <textarea wire:model="tables.{{ $tableIndex }}.rows.{{ $rowIndex }}.good"
                                              class="w-full p-1 text-sm border border-gray-300 rounded resize-none"
                                              rows="3"
                                              placeholder="Voer goed criteria in..."></textarea>
                                    </td>
                                    <td class="border border-gray-300 p-2 text-center">
                                        <input type="number"
                                               wire:model.live="tables.{{ $tableIndex }}.rows.{{ $rowIndex }}.points"
                                               class="w-16 p-1 text-sm border border-gray-300 rounded text-center"
                                               min="0"
                                               max="5">
                                    </td>
                                    <td class="border border-gray-300 p-2">
                                        <textarea wire:model="tables.{{ $tableIndex }}.rows.{{ $rowIndex }}.remarks"
                                                  class="w-full p-1 text-sm border border-gray-300 rounded resize-none"
                                                  rows="3"
                                                  placeholder="Voer opmerkingen in..."></textarea>
                                        @if(count($table['rows']) > 1)
                                            <button type="button"
                                                    wire:click="removeRow({{ $tableIndex }}, {{ $rowIndex }})"
                                                    class="mt-2 text-red-600 text-sm hover:text-red-800">
                                                Verwijder rij
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="5" class="border border-gray-300 p-2 text-right font-semibold">
                                    Totaal behaalde punten
                                </td>
                                <td class="border border-gray-300 p-2 text-center bg-blue-100">
                                    <span class="font-bold">{{ $this->getTotalPoints($tableIndex) }}</span>
                                </td>
                                <td class="border border-gray-300 p-2 bg-blue-100">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="border border-gray-300 p-2">
                                <textarea wire:model="tables.{{ $tableIndex }}.description_1"
                                          class="w-full p-1 text-sm border border-gray-300 rounded resize-none"
                                          rows="5"
                                          placeholder="Voer hier je tekst in..."></textarea>
                                </td>
                                <td colspan="4" class="border border-gray-300 p-2">
                                    <div class="flex items-center justify-between mb-3 last:mb-0">
                                        <input type="text"
                                               wire:model="tables.{{ $tableIndex }}.deliverable_text"
                                               class="flex-1 p-2 border border-gray-300 rounded mr-4"
                                               placeholder="Deliverable tekst....">
                                        <input type="checkbox"
                                               wire:model="tables.{{ $tableIndex }}.deliverable_checked"
                                               class="h-5 w-5 text-blue-600 rounded border-gray-300">
                                    </div>
                                    <hr class="border-black my-3">
                                    @foreach($table['knockoutCriteria'] as $koIndex => $criteria)
                                        <div class="flex items-center justify-between mb-3 last:mb-0">
                                            <input type="text"
                                                   wire:model.live="tables.{{ $tableIndex }}.knockoutCriteria.{{ $koIndex }}.text"
                                                   class="flex-1 p-2 border border-gray-300 rounded mr-4"
                                                   placeholder="Voer knock-out criteria in...">
                                            <input type="checkbox"
                                                   wire:model.live="tables.{{ $tableIndex }}.knockoutCriteria.{{ $koIndex }}.checked"
                                                   class="h-5 w-5 text-blue-600 rounded border-gray-300">
                                            @if(count($table['knockoutCriteria']) > 1)
                                                <button type="button"
                                                        wire:click="removeKnockoutCriteria({{ $tableIndex }}, {{ $koIndex }})"
                                                        class="mt-2 text-red-600 text-sm hover:text-red-800">
                                                    Verwijder rij
                                                </button>
                                            @endif
                                        </div>
                                    @endforeach
                                    <button type="button"
                                            wire:click="addKnockoutCriteria({{ $tableIndex }})"
                                            class="mt-3 text-blue-600 hover:text-blue-800 text-sm">
                                        + Voeg nog een criterium toe
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7" class="border border-gray-300 p-2">
                                <textarea wire:model="tables.{{ $tableIndex }}.description_2"
                                          class="w-full p-1 text-sm border border-gray-300 rounded resize-none"
                                          rows="7"
                                          placeholder="Voer hier je tekst in..."></textarea>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="mt-4 flex justify-center gap-4">
                            <button type="button"
                                    wire:click="addRow({{ $tableIndex }})"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Nieuwe rij toevoegen
                            </button>
                        </div>
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
