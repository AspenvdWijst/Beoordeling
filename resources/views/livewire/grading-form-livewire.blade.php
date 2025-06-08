<div class="flex flex-col items-center justify-center min-h-screen bg-gray-50">
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

            <form wire:submit.prevent="save">
                <div class="mb-6">
                    <label class="block font-bold mb-2">Titel formulier</label>
                    <input type="text" wire:model="formTitle"
                           class="w-full border p-2 rounded @error('formTitle') border-red-500 bg-red-50 @enderror"
                           placeholder="Voer hier de titel van het formulier in">

                    @error('formTitle')
                    <div x-data="{show: true}"
                         x-init="setTimeout(() => show = false, 3000"
                         x-show="show"
                         class="flex items-center mt-1 text-red-600 text-sm">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01"/>
                        </svg>
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block font-bold mb-2">Kies opdracht</label>
                    <select wire:model="selectedAssignment"
                            class="w-full border p-2 rounded @error('selectedAssignment') border-red-500 bg-red-50 @enderror">
                        <option value="">-- Selecteer een opdracht --</option>
                        @foreach($assignments as $assignment)
                            <option value="{{ $assignment->id }}">
                                {{ $assignment->assignment_name ?? 'Opdracht #' . $assignment->id }}
                            </option>
                        @endforeach
                    </select>

                    @error('selectedAssignment')
                    <div x-data="{show: true}"
                         x-init="setTimeout(() => show = false, 3000"
                         x-show="show"
                         class="flex items-center mt-1 text-red-600 text-sm">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01"/>
                        </svg>
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div>
                    @include('livewire.partials.grading-frontpage', [
                        'tables' => $tables,])
                </div>

                <button type="button" wire:click="addTable" class="mb-4 px-4 py-2 bg-blue-500 text-white rounded">
                    Tabel toevoegen
                </button>
                <div class="flex flex-col gap-6 mt-6">
                    @foreach($tables as $tableIndex => $table)
                        @if(isset($table['rows']) && is_array($table['rows']))
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <input type="text"
                                           wire:model="tables.{{ $tableIndex }}.title"
                                           class="flex-1 p-2 text-lg border border-gray-300 font-bold bg-blue-50 @error('tables.' . $tableIndex . '.title') border-red-500 bg-red-50 @enderror"
                                           placeholder="Voer competentie analyse titel in...">
                                    <button type="button"
                                            wire:click="removeTable({{ $tableIndex }})"
                                            class="ml-4 px-3 py-1 bg-red-100 text-red-600 rounded hover:bg-red-200 transition">
                                        Tabel verwijderen
                                    </button>
                                </div>

                                @error('tables.' . $tableIndex . '.title')
                                <div x-data="{show: true}"
                                     x-init="setTimeout(() => show = false, 3000"
                                     x-show="show"
                                     class="flex items-center mt-1 text-red-600 text-sm">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2"
                                         viewBox="0 0 24 24">
                                        <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"
                                                fill="none"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01"/>
                                    </svg>
                                    {{ $message }}
                                </div>
                                @enderror

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
                                        @foreach (is_array($table['rows'] ?? null) ? $table['rows'] : [] as $rowIndex => $row)
                                            <tr>
                                                <td class="border border-gray-300 p-2 bg-gray-100">
                                                    <input type="text"
                                                           wire:model="tables.{{ $tableIndex }}.rows.{{ $rowIndex }}.component"
                                                           class="w-full p-1 text-sm border border-gray-300 rounded @error('tables.' . $tableIndex . '.rows.' . $rowIndex . '.component') border-red-500 bg-red-50 @enderror"
                                                           placeholder="Voer component in...">

                                                    @error('tables.' . $tableIndex . '.rows.' . $rowIndex . '.component')
                                                    <div x-data="{show: true}"
                                                         x-init="setTimeout(() => show = false, 3000"
                                                         x-show="show"
                                                         class="flex items-center mt-1 text-red-600 text-sm">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                             stroke-width="2"
                                                             viewBox="0 0 24 24">
                                                            <circle cx="12" cy="12" r="10" stroke="currentColor"
                                                                    stroke-width="2" fill="none"/>
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  d="M12 8v4m0 4h.01"/>
                                                        </svg>
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </td>
                                                <td class="border border-gray-300 p-2">
                                                    <textarea
                                                        wire:model="tables.{{ $tableIndex }}.rows.{{ $rowIndex }}.description"
                                                        class="w-full p-1 text-sm border border-gray-300 rounded resize-none @error('tables.' . $tableIndex . '.rows.' . $rowIndex . '.description') border-red-500 bg-red-50 @enderror"
                                                        rows="3"
                                                        placeholder="Voer beschrijving in..."></textarea>

                                                    @error('tables.' . $tableIndex . '.rows.' . $rowIndex . '.description')
                                                    <div x-data="{show: true}"
                                                         x-init="setTimeout(() => show = false, 3000"
                                                         x-show="show"
                                                         class="flex items-center mt-1 text-red-600 text-sm">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                             stroke-width="2"
                                                             viewBox="0 0 24 24">
                                                            <circle cx="12" cy="12" r="10" stroke="currentColor"
                                                                    stroke-width="2" fill="none"/>
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  d="M12 8v4m0 4h.01"/>
                                                        </svg>
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </td>
                                                <td class="border border-gray-300 p-2">
                                                    <textarea
                                                        wire:model="tables.{{ $tableIndex }}.rows.{{ $rowIndex }}.insufficient"
                                                        class="w-full p-1 text-sm border border-gray-300 rounded resize-none @error('tables.' . $tableIndex . '.rows.' . $rowIndex . '.insufficient') border-red-500 bg-red-50 @enderror"
                                                        rows="3"
                                                        placeholder="Voer onvoldoende criteria in..."></textarea>

                                                    @error('tables.' . $tableIndex . '.rows.' . $rowIndex . '.insufficient')
                                                    <div x-data="{show: true}"
                                                         x-init="setTimeout(() => show = false, 3000"
                                                         x-show="show"
                                                         class="flex items-center mt-1 text-red-600 text-sm">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                             stroke-width="2"
                                                             viewBox="0 0 24 24">
                                                            <circle cx="12" cy="12" r="10" stroke="currentColor"
                                                                    stroke-width="2" fill="none"/>
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  d="M12 8v4m0 4h.01"/>
                                                        </svg>
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </td>
                                                <td class="border border-gray-300 p-2">
                                                    <textarea
                                                        wire:model="tables.{{ $tableIndex }}.rows.{{ $rowIndex }}.sufficient"
                                                        class="w-full p-1 text-sm border border-gray-300 rounded resize-none @error('tables.' . $tableIndex . '.rows.' . $rowIndex . '.sufficient') border-red-500 bg-red-50 @enderror"
                                                        rows="3"
                                                        placeholder="Voer voldoende criteria in..."></textarea>

                                                    @error('tables.' . $tableIndex . '.rows.' . $rowIndex . '.sufficient')
                                                    <div x-data="{show: true}"
                                                         x-init="setTimeout(() => show = false, 3000"
                                                         x-show="show"
                                                         class="flex items-center mt-1 text-red-600 text-sm">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                             stroke-width="2"
                                                             viewBox="0 0 24 24">
                                                            <circle cx="12" cy="12" r="10" stroke="currentColor"
                                                                    stroke-width="2" fill="none"/>
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  d="M12 8v4m0 4h.01"/>
                                                        </svg>
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </td>
                                                <td class="border border-gray-300 p-2">
                                                    <textarea
                                                        wire:model="tables.{{ $tableIndex }}.rows.{{ $rowIndex }}.good"
                                                        class="w-full p-1 text-sm border border-gray-300 rounded resize-none @error('tables.' . $tableIndex . '.rows.' . $rowIndex . '.good') border-red-500 bg-red-50 @enderror"
                                                        rows="3"
                                                        placeholder="Voer goed criteria in..."></textarea>

                                                    @error('tables.' . $tableIndex . '.rows.' . $rowIndex . '.good')
                                                    <div x-data="{show: true}"
                                                         x-init="setTimeout(() => show = false, 3000"
                                                         x-show="show"
                                                         class="flex items-center mt-1 text-red-600 text-sm">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                             stroke-width="2"
                                                             viewBox="0 0 24 24">
                                                            <circle cx="12" cy="12" r="10" stroke="currentColor"
                                                                    stroke-width="2" fill="none"/>
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  d="M12 8v4m0 4h.01"/>
                                                        </svg>
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </td>
                                                <td class="border border-gray-300 p-2 text-center">
                                                    <span class="font-semibold">0</span>
                                                </td>
                                                <td class="border border-gray-300 p-2">
                                                    <span class="font-semibold"></span>
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
                                                <span class="font-bold">0</span>
                                            </td>
                                            <td class="border border-gray-300 p-2 bg-blue-100">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="border border-gray-300 p-2">
                                                <textarea wire:model="tables.{{ $tableIndex }}.description_1"
                                                          class="w-full p-1 text-sm border border-gray-300 rounded resize-none @error('tables.' . $tableIndex . '.description_1') border-red-500 bg-red-50 @enderror"
                                                          rows="5"
                                                          placeholder="Voer hier je tekst in..."></textarea>

                                                @error('tables.' . $tableIndex . '.description_1')
                                                <div x-data="{show: true}"
                                                     x-init="setTimeout(() => show = false, 3000"
                                                     x-show="show"
                                                     class="flex items-center mt-1 text-red-600 text-sm">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                         stroke-width="2"
                                                         viewBox="0 0 24 24">
                                                        <circle cx="12" cy="12" r="10" stroke="currentColor"
                                                                stroke-width="2" fill="none"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M12 8v4m0 4h.01"/>
                                                    </svg>
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </td>
                                            <td colspan="4" class="border border-gray-300 p-2">
                                                <div class="flex items-center justify-between mb-3 last:mb-0">
                                                    <input type="text"
                                                           wire:model="tables.{{ $tableIndex }}.deliverable_text"
                                                           class="flex-1 p-2 border border-gray-300 rounded mr-4 @error('tables.' . $tableIndex . '.deliverable_text') border-red-500 bg-red-50 @enderror"
                                                           placeholder="Deliverable tekst....">

                                                    @error('tables.' . $tableIndex . '.deliverable_text')
                                                    <div x-data="{show: true}"
                                                         x-init="setTimeout(() => show = false, 3000"
                                                         x-show="show"
                                                         class="flex items-center mt-1 text-red-600 text-sm">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                             stroke-width="2"
                                                             viewBox="0 0 24 24">
                                                            <circle cx="12" cy="12" r="10" stroke="currentColor"
                                                                    stroke-width="2" fill="none"/>
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  d="M12 8v4m0 4h.01"/>
                                                        </svg>
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <hr class="border-black my-3">
{{--                                                @foreach($table['knockoutCriteria'] as $koIndex => $criteria)--}}
                                                @foreach(is_array($table['knockoutCriteria']) ? $table['knockoutCriteria'] : [] as $koIndex => $criteria)
                                                    <div class="flex items-center justify-between mb-3 last:mb-0">
                                                        <input type="text"
                                                               wire:model="tables.{{ $tableIndex }}.knockoutCriteria.{{ $koIndex }}.text"
                                                               class="flex-1 p-2 border border-gray-300 rounded mr-4 @error('tables.' . $tableIndex . '.knockoutCriteria' . $koIndex . '.text') border-red-500 bg-red-50 @enderror"
                                                               placeholder="Voer knock-out criteria in...">
                                                        @if(count($table['knockoutCriteria']) > 1)
                                                            <button type="button"
                                                                    wire:click="removeKnockoutCriteria({{ $tableIndex }}, {{ $koIndex }})"
                                                                    class="mt-2 text-red-600 text-sm hover:text-red-800">
                                                                Verwijder rij
                                                            </button>
                                                        @endif

                                                        @error('tables.' . $tableIndex . '.knockoutCriteria' . $koIndex . '.text')
                                                        <div x-data="{show: true}"
                                                             x-init="setTimeout(() => show = false, 3000"
                                                             x-show="show"
                                                             class="flex items-center mt-1 text-red-600 text-sm">
                                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                                 stroke-width="2"
                                                                 viewBox="0 0 24 24">
                                                                <circle cx="12" cy="12" r="10" stroke="currentColor"
                                                                        stroke-width="2" fill="none"/>
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                      d="M12 8v4m0 4h.01"/>
                                                            </svg>
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
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
                                                          class="w-full p-1 text-sm border border-gray-300 rounded resize-none @error('tables.' . $tableIndex . '.description_2') border-red-500 bg-red-50 @enderror"
                                                          rows="7"
                                                          placeholder="Voer hier je tekst in..."></textarea>

                                                @error('tables.' . $tableIndex . '.description_2')
                                                <div x-data="{show: true}"
                                                     x-init="setTimeout(() => show = false, 3000"
                                                     x-show="show"
                                                     class="flex items-center mt-1 text-red-600 text-sm">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                         stroke-width="2"
                                                         viewBox="0 0 24 24">
                                                        <circle cx="12" cy="12" r="10" stroke="currentColor"
                                                                stroke-width="2" fill="none"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M12 8v4m0 4h.01"/>
                                                    </svg>
                                                    {{ $message }}
                                                </div>
                                                @enderror
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
