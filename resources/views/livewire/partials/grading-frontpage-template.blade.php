<div wire:poll="500ms" class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
    <div class="grid gap-4 md:grid-cols-2">
        <div class="border border-neutral-200 dark:border-neutral-700 overflow-x-auto bg-white dark:bg-neutral-800">
            <table class="table-auto min-w-full border border-gray-400">
                <thead>
                <tr>
                    <th colspan="2"
                        class="bg-blue-400 text-white text-lg py-3 text-center border border-gray-400">
                        Gegevens
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr class="border border-gray-400">
                    <td class="border border-gray-400 p-3 bg-white">
                        <div class="flex">
                            <label for="studentName" class="font-semibold mb-0">Studentnaam:</label>
                        </div>
                    </td>
                    <td class="border border-gray-400 p-3 bg-white">
                        <span>{{ $this->student_name }}</span>
                    </td>
                </tr>
                <tr class="border border-gray-400">
                    <td class="border border-gray-400 p-3 bg-white">
                        <div class="flex items-center">
                            <label for="studentNumber" class="font-semibold mb-0">Studentnummer:</label>
                        </div>
                    </td>
                    <td class="border border-gray-400 p-3 bg-white">
                        <div class="flex" x-data>
                            <input
                                wire:model.debounce.500ms="form.student_number"
                                type="text"
                                id="studentNumber"
                                name="studentNumber"
                                placeholder="<studentnummer>"
                                class="border border-gray-300 rounded px-2 py-1 w-full @error('form.student_number') border-red-500 bg-red-50 @enderror"
                                x-on:input="$event.target.value = $event.target.value.replace(/[^0-9]/g, '')"
                                @if($locked) disabled style="background-color: #f3f4f6; color: #888;" @endif
                            >
                        </div>

                        @error('form.student_number')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td class="border border-gray-400 p-3 bg-white">
                        <div class="flex">
                            <label for="gradingDate" class="font-semibold mb-0">Datum beoordeling:</label>
                        </div>
                    </td>
                    <td class="border border-gray-400 p-3 bg-white">
                        <div class="flex">
                            <input wire:model.debounce.500ms="form.grading_date" type="date" id="gradingDate"
                                   name="gradingDate"
                                   class="border border-gray-300 rounded px-2 py-1 w-full @error('form.grading_date') border-red-500 bg-red 50 @enderror"
                                   @if($locked) disabled style="background-color: #f3f4f6; color: #888;" @endif>
                        </div>
                        @error('form.grading_date')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </td>
                </tr>
                <tr class="border border-gray-400">
                    <td class="border border-gray-400 p-3 bg-white">
                        <div class="flex">
                            <label for="oeCode" class="font-semibold mb-0">OE-code:</label>
                        </div>
                    </td>
                    <td class="border border-gray-400 p-3 bg-white">
                        <div class="flex">
                            <input wire:model.debounce.500ms="form.oe_code" type="text" id="oeCode" name="oeCode"
                                   placeholder="<OE-code>"
                                   class="border border-gray-300 rounded px-2 py-1 w-full @error('form.oe_code') border-red-500 bg-red 50 @enderror"
                                   @if($locked) disabled style="background-color: #f3f4f6; color: #888;" @endif>
                        </div>
                        @error('form.oe_code')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td class="border border-gray-400 p-3 bg-white">
                        <div class="flex">
                            <label for="startPeriod" class="font-semibold mb-0">Datum aanvang Comaker en
                                einddatum:</label>
                        </div>
                    </td>
                    <td class="border border-gray-400 p-3 bg-white">
                        <div class="flex">
                            <input wire:model.debounce.500ms="form.start_period" type="date" id="startPeriod"
                                   name="startPeriod"
                                   class="border border-gray-300 rounded px-2 py-1 w-1/3 @error('form.start_period') border-red-500 bg-red 50 @enderror"
                                   @if($locked) disabled style="background-color: #f3f4f6; color: #888;" @endif>
                            <span class="font-semibold mb-0">tot</span>
                            <input wire:model.debounce.500ms="form.end_period" type="date" id="endPeriod"
                                   name="endPeriod"
                                   class="border border-gray-300 rounded px-2 py-1 w-1/3 @error('form.end_period') border-red-500 bg-red 50 @enderror"
                                   @if($locked) disabled style="background-color: #f3f4f6; color: #888;" @endif>
                        </div>
                        @error('form.start_period')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                        @error('form.end_period')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </td>
                </tr>
                <tr class="border border-gray-400">
                    <td class="border border-gray-400 p-3 bg-white">
                        <div class="flex">
                            <label for="titleAssignment" class="font-semibold mb-0">Titel opdracht:</label>
                        </div>
                    </td>
                    <td class="border border-gray-400 p-3 bg-white">
                        <div class="flex">
                            <input wire:model.debounce.500ms="form.title_assignment" type="text" id="titleAssignment"
                                   name="titleAssignment" placeholder="<titel>"
                                   class="border border-gray-300 rounded px-2 py-1 w-full @error('form.title_assignment') border-red-500 bg-red 50 @enderror"
                                   @if($locked) disabled style="background-color: #f3f4f6; color: #888;" @endif>
                        </div>
                        @error('form.title_assignment')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td class="border border-gray-400 p-3 bg-white">
                        <div class="flex">
                            <label for="companyName" class="font-semibold mb-0">Bedrijfsnaam en -plaats:</label>
                        </div>
                    </td>
                    <td class="border border-gray-400 p-3 bg-white">
                        <div class="flex">
                            <input wire:model.debounce.500ms="form.company_name" type="text" id="companyName"
                                   name="companyName"
                                   placeholder="<bedrijfsnaam>"
                                   class="border border-gray-300 rounded px-2 py-1 w-1/3 @error('form.company_name') border-red-500 bg-red 50 @enderror"
                                   @if($locked) disabled style="background-color: #f3f4f6; color: #888;" @endif>
                            <span class="font-semibold mb-0">te</span>
                            <input wire:model.debounce.500ms="form.company_place" type="text" id="companyPlace"
                                   name="companyPlace"
                                   placeholder="<plaats>"
                                   class="border border-gray-300 rounded px-2 py-1 w-1/3 @error('form.company_place') border-red-500 bg-red 50 @enderror"
                                   @if($locked) disabled style="background-color: #f3f4f6; color: #888;" @endif>
                        </div>
                        @error('form.company_name')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                        @error('form.company_place')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="border border-neutral-200 dark:border-neutral-700 overflow-x-auto bg-white dark:bg-neutral-800">
            <table class="table-auto min-w-full border border-gray-400">
                <thead>
                <tr>
                    <th colspan="1" class="bg-blue-400 text-white text-lg py-3 text-center border border-gray-400">
                        Eindbeoordeling
                    </th>
                    <th colspan="1" class="bg-blue-400 text-white text-lg py-3 text-center border border-gray-400">
                        Totaal te behalen punten:
                    </th>
                    <th colspan="1" class="bg-blue-400 text-white text-lg py-3 text-center border border-gray-400">
                        Behaald
                    </th>
                    <th colspan="1" class="bg-blue-400 text-white text-lg py-3 text-center border border-gray-400">
                        Minimale punten eis
                    </th>
                    <th colspan="1" class="bg-blue-400 text-white text-lg py-3 text-center border border-gray-400">
                        Punten range
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($form['tables'] as $tableIndex => $table)
                    <tr class="border border-gray-400">
                        <td class="border border-gray-400 p-3 bg-white">
                            <label for="naam" class="block font-semibold mb-1">{{ $table['title'] }}</label>
                        </td>
                        <td class="border border-gray-400 p-3 bg-white">
                            <span>{{ $table['max_points'] }}</span>
                        </td>
                        <td class="border border-gray-400 p-3 bg-orange-300 text-right">
                            <span class="font-bold">{{ $this->getTotalPoints($tableIndex) }}</span>
                        </td>
                        <td class="border border-gray-400 p-3 bg-white">
                            <span>{{ $table['min_points'] }}</span>
                        </td>
                        <td class="border border-gray-400 p-3 bg-white">
                            @if(isset($table['point_ranges']) && is_array($table['point_ranges']))
                                @foreach($table['point_ranges'] as $range)
                                    <div>
                                        <span class="font-semibold">{{ ucfirst($range['label']) }}:</span>
                                        <span>{{ $range['min_points'] }} - {{ $range['max_points'] }}</span>
                                    </div>
                                @endforeach
                            @else
                                <span class="text-gray-400">Geen ranges</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                <tr class="border border-gray-400">
                    <td class="border border-gray-400 p-3 bg-white"></td>
                    <td class="border border-gray-400 bg-white text-right">
                        <span class="font-bold">{{ $maxObtainablePoints }}</span>
                    </td>
                    <td class="border border-gray-400 p-3 bg-white text-right">
                        <span class="font-bold">{{ $grandTotal }}</span>
                    </td>
                    <td class="border border-gray-400 p-3 bg-white text-right">
                        <span class="font-bold">{{ $minObtainablePoints }}</span>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="border border-neutral-200 dark:border-neutral-700 overflow-x-auto bg-white dark:bg-neutral-800">
        <table class="table-auto min-w-full border border-gray-400">
            <thead>
            <tr>
                <th colspan="6" class="bg-blue-400 text-white text-lg py-3 text-center border border-gray-400">
                    Competentieprofiel en niveaus
                </th>
            </tr>
            </thead>
            <tbody>
            <tr class="border border-gray-400">
                <td class="border border-gray-400 p-3 bg-white">
                    <label for="naam" class="block font-semibold mb-1">Activiteit</label>
                </td>
                <td class="border border-gray-400 p-3 bg-white">
                    <label for="naam" class="block font-semibold mb-1">Analyseren</label>
                </td>
                <td class="border border-gray-400 p-3 bg-white">
                    <label for="naam" class="block font-semibold mb-1">Adviseren</label>
                </td>
                <td class="border border-gray-400 p-3 bg-white">
                    <label for="naam" class="block font-semibold mb-1">Ontwerpen</label>
                </td>
                <td class="border border-gray-400 p-3 bg-white">
                    <label for="naam" class="block font-semibold mb-1">Realiseren</label>
                </td>
                <td class="border border-gray-400 p-3 bg-white">
                    <label for="naam" class="block font-semibold mb-1">Manage & control</label>
                </td>
            </tr>
            <tr class="border border-gray-400">
                <td class="border border-gray-400 p-3 bg-white">
                    <label for="naam" class="block font-semibold mb-1">Gebruikersinteractie</label>
                </td>
            </tr>
            <tr class="border border-gray-400">
                <td class="border border-gray-400 p-3 bg-white">
                    <label for="naam" class="block font-semibold mb-1">Organisatieprocessen</label>
                </td>
            </tr>
            <tr class="border border-gray-400">
                <td class="border border-gray-400 p-3 bg-white">
                    <label for="naam" class="block font-semibold mb-1">Infrastructuur</label>
                </td>
            </tr>
            <tr class="border border-gray-400">
                <td class="border border-gray-400 p-3 bg-blue-400 text-white">
                    <label for="naam" class="block font-semibold mb-1">Software</label>
                </td>
                <td class="border border-gray-400 p-3 bg-blue-400 text-white">
                    <input wire:model.debounce.500ms="form.software.analyse" type="number"
                           class="w-16 p-1 text-sm border border-gray-300 rounded text-center"
                           min="0" max="2"
                           @if($locked) disabled style="background-color: #f3f4f6; color: #888;" @endif>
                </td>
                <td class="border border-gray-400 p-3 bg-blue-400 text-white">
                    <input wire:model.debounce.500ms="form.software.advise"  type="number"
                           class="w-16 p-1 text-sm border border-gray-300 rounded text-center"
                           min="0" max="2"
                           @if($locked) disabled style="background-color: #f3f4f6; color: #888;" @endif>
                </td>
                <td class="border border-gray-400 p-3 bg-blue-400 text-white">
                    <input wire:model.debounce.500ms="form.software.design"  type="number"
                           class="w-16 p-1 text-sm border border-gray-300 rounded text-center"
                           min="0" max="2"
                           @if($locked) disabled style="background-color: #f3f4f6; color: #888;" @endif>
                </td>
                <td class="border border-gray-400 p-3 bg-blue-400 text-white">
                    <input wire:model.debounce.500ms="form.software.realise"  type="number"
                           class="w-16 p-1 text-sm border border-gray-300 rounded text-center"
                           min="0" max="2"
                           @if($locked) disabled style="background-color: #f3f4f6; color: #888;" @endif>
                </td>
                <td class="border border-gray-400 p-3 bg-blue-400 text-white">
                    <input wire:model.debounce.500ms="form.software.manage"  type="number"
                           class="w-16 p-1 text-sm border border-gray-300 rounded text-center"
                           min="0" max="2"
                           @if($locked) disabled style="background-color: #f3f4f6; color: #888;" @endif>
                </td>
            </tr>
            <tr class="border border-gray-400">
                <td class="border border-gray-400 p-3 bg-white">
                    <label for="naam" class="block font-semibold mb-1">Hardware interfacing</label>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="grid auto-rows-min gap-4 md:grid-cols-2 mt-6">
            <div class="relative h-full flex-1 overflow-hidden border border-neutral-200 dark:border-neutral-700">
                <table class="table-auto min-w-full border border-gray-400">
                    <thead>
                    <tr>
                        <th colspan="6" class="bg-blue-400 text-white text-lg py-3 text-center border border-gray-400">
                            Punten omzetten naar cijfer
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="border border-gray-400">
                        <td class="border border-gray-400 p-3 bg-white">
                            <span class="font-semibold">72-79</span>
                        </td>
                        <td class="border border-gray-400 p-3 bg-white">
                            <span class="font-semibold">5.5</span>
                        </td>
                    </tr>
                    <tr class="border border-gray-400">
                        <td class="border border-gray-400 p-3 bg-white">
                            <span class="font-semibold">80-89</span>
                        </td>
                        <td class="border border-gray-400 p-3 bg-white">
                            <span class="font-semibold">6</span>
                        </td>
                    </tr>
                    <tr class="border border-gray-400">
                        <td class="border border-gray-400 p-3 bg-white">
                            <span class="font-semibold">90-97</span>
                        </td>
                        <td class="border border-gray-400 p-3 bg-white">
                            <span class="font-semibold">6.5</span>
                        </td>
                    </tr>
                    <tr class="border border-gray-400">
                        <td class="border border-gray-400 p-3 bg-white">
                            <span class="font-semibold">98-105</span>
                        </td>
                        <td class="border border-gray-400 p-3 bg-white">
                            <span class="font-semibold">7</span>
                        </td>
                    </tr>
                    <tr class="border border-gray-400">
                        <td class="border border-gray-400 p-3 bg-white">
                            <span class="font-semibold">106-114</span>
                        </td>
                        <td class="border border-gray-400 p-3 bg-white">
                            <span class="font-semibold">7.5</span>
                        </td>
                    </tr>
                    <tr class="border border-gray-400">
                        <td class="border border-gray-400 p-3 bg-white">
                            <span class="font-semibold">115-123</span>
                        </td>
                        <td class="border border-gray-400 p-3 bg-white">
                            <span class="font-semibold">8</span>
                        </td>
                    </tr>
                    <tr class="border border-gray-400">
                        <td class="border border-gray-400 p-3 bg-white">
                            <span class="font-semibold">124-131</span>
                        </td>
                        <td class="border border-gray-400 p-3 bg-white">
                            <span class="font-semibold">8.5</span>
                        </td>
                    </tr>
                    <tr class="border border-gray-400">
                        <td class="border border-gray-400 p-3 bg-white">
                            <span class="font-semibold">132-140</span>
                        </td>
                        <td class="border border-gray-400 p-3 bg-white">
                            <span class="font-semibold">9</span>
                        </td>
                    </tr>
                    <tr class="border border-gray-400">
                        <td class="border border-gray-400 p-3 bg-white">
                            <span class="font-semibold">141-148</span>
                        </td>
                        <td class="border border-gray-400 p-3 bg-white">
                            <span class="font-semibold">9.5</span>
                        </td>
                    </tr>
                    <tr class="border border-gray-400">
                        <td class="border border-gray-400 p-3 bg-white">
                            <span class="font-semibold">149-150</span>
                        </td>
                        <td class="border border-gray-400 p-3 bg-white">
                            <span class="font-semibold">10</span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-4 flex flex-row flex-wrap gap-4">
                <div
                    class="rounded-lg p-4 flex items-center gap-2  w-fit min-w-[140px]">
                    <span class="font-semibold text-blue-700">Herkansing:</span>
                    <input wire:model.debounce.500ms="form.retry" type="checkbox" class="h-5 w-5"
                           @if($locked) disabled style="background-color: #f3f4f6; color: #888;" @endif
                           @if($this->retryLoaded) disabled style="background-color: #f3f4f6; color: #888;" @endif
                           @if($this->retryFilled) disabled style="background-color: #f3f4f6; color: #888;" @endif/>
                </div>
                <div
                    class="rounded-lg p-4 flex items-center gap-2 w-fit min-w-[140px]">
                    <span class="font-semibold text-blue-700">Beoordeling:</span>
                    <span class="font-bold">{{ $grade ?? '5' }}</span>
                </div>
                <div class="flex flex-col items-center justify-center gap-2 flex-1 min-w-[220px]">
                    <span class="font-semibold text-blue-700 mb-1">Ondertekening:</span>
                    <div class="flex flex-wrap gap-2">
                        @foreach($teacherApprovals as $teacher)
                            <div class="flex items-center gap-2 p-2 rounded-md border
                    @if($teacher['approved'])
                        border-green-400 bg-green-50
                    @else
                        border-gray-300 bg-gray-50
                    @endif
                    min-w-[180px] max-w-full flex-1"
                                 style="min-width: 180px; max-width: 100%;">
                                <div class="flex-shrink-0">
                                    @if($teacher['approved'])
                                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"/>
                                            <path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M7 13l3 3 5-5"/>
                                        </svg>
                                    @else
                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"/>
                                            <path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M8 12h8"/>
                                        </svg>
                                    @endif
                                </div>
                                <div class="flex flex-col min-w-0">
                                    <span class="font-medium text-gray-800 truncate" title="{{ $teacher['name'] }}">{{ $teacher['name'] }}</span>
                                    @if($teacher['approved'])
                                        <span class="text-green-700 text-xs truncate" title="Goedgekeurd op {{ \Carbon\Carbon::parse($teacher['approved_at'])->format('d-m-Y H:i') }}">
                                {{ \Carbon\Carbon::parse($teacher['approved_at'])->format('d-m-Y H:i') }}
                            </span>
                                    @else
                                        <span class="text-gray-500 text-xs truncate">Nog niet goedgekeurd</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
