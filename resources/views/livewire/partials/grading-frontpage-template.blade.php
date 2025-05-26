<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
    <div class="grid auto-rows-min gap-4 md:grid-cols-2">
        <div class="relative aspect-video border-neutral-200 dark:border-neutral-700">
            <div class="overflow-x-auto">
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
                            <div class="flex">
                                <input wire:model.debounce.1000ms="form.student_name" type="text" id="studentName" name="studentName"
                                       placeholder="<naam student>"
                                       class="border border-gray-300 rounded px-2 py-1 w-full">
                            </div>
                        </td>
                    </tr>
                    <tr class="border border-gray-400">
                        <td class="border border-gray-400 p-3 bg-white">
                            <div class="flex items-center">
                                <label for="studentNumber" class="font-semibold mb-0">Studentnummer:</label>
                            </div>
                        </td>
                        <td class="border border-gray-400 p-3 bg-white">
                            <div class="flex">
                                <input wire:model.debounce.1000ms="form.student_number" type="text" id="studentNumber" name="studentNumber"
                                       placeholder="<studentnummer>"
                                       class="border border-gray-300 rounded px-2 py-1 w-full">
                            </div>
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
                                <input wire:model.debounce.1000ms="form.grading_date" type="date" id="gradingDate" name="gradingDate"
                                       class="border border-gray-300 rounded px-2 py-1 w-full">
                            </div>
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
                                <input wire:model.debounce.1000ms="form.oe_code" type="text" id="oeCode" name="oeCode" placeholder="<OE-code>"
                                       class="border border-gray-300 rounded px-2 py-1 w-full">
                            </div>
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
                                <input wire:model.debounce.1000ms="form.start_period" type="date" id="startPeriod" name="startPeriod"
                                       class="border border-gray-300 rounded px-2 py-1 w-1/3">
                                <span class="font-semibold mb-0">tot</span>
                                <input wire:model.debounce.1000ms="form.end_period" type="date" id="endPeriod" name="endPeriod"
                                       class="border border-gray-300 rounded px-2 py-1 w-1/3">
                            </div>
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
                                <input wire:model.debounce.1000ms="form.title_assignment" type="text" id="titleAssignment"
                                       name="titleAssignment" placeholder="<titel>"
                                       class="border border-gray-300 rounded px-2 py-1 w-full">
                            </div>
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
                                <input wire:model.debounce.1000ms="form.company_name" type="text" id="companyName" name="companyName"
                                       placeholder="<bedrijfsnaam>"
                                       class="border border-gray-300 rounded px-2 py-1 w-1/3">
                                <span class="font-semibold mb-0">te</span>
                                <input wire:model.debounce.1000ms="form.company_place" type="text" id="companyPlace" name="companyPlace"
                                       placeholder="<plaats>"
                                       class="border border-gray-300 rounded px-2 py-1 w-1/3">
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div
            class="relative aspect-video border-neutral-200 dark:border-neutral-700">
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
    <div
        class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
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
                    <input type="number"
                           class="w-16 p-1 text-sm border border-gray-300 rounded text-center"
                           min="0">
                </td>
                <td class="border border-gray-400 p-3 bg-blue-400 text-white">
                    <input type="number"
                           class="w-16 p-1 text-sm border border-gray-300 rounded text-center"
                           min="0">
                </td>
                <td class="border border-gray-400 p-3 bg-blue-400 text-white">
                    <input type="number"
                           class="w-16 p-1 text-sm border border-gray-300 rounded text-center"
                           min="0">
                </td>
                <td class="border border-gray-400 p-3 bg-blue-400 text-white">
                    <input type="number"
                           class="w-16 p-1 text-sm border border-gray-300 rounded text-center"
                           min="0">
                </td>
                <td class="border border-gray-400 p-3 bg-blue-400 text-white">
                    <input type="number"
                           class="w-16 p-1 text-sm border border-gray-300 rounded text-center"
                           min="0">
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
            <div
                class="relative h-full flex-1 overflow-hidden border border-neutral-200 dark:border-neutral-700">
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
                            <span class="font-semibold">72-77</span>
                        </td>
                        <td class="border border-gray-400 p-3 bg-white">
                            <span class="font-semibold">5,5</span>
                        </td>
                    </tr>
                    <tr class="border border-gray-400">
                        <td class="border border-gray-400 p-3 bg-white">
                            <span class="font-semibold">78-83</span>
                        </td>
                        <td class="border border-gray-400 p-3 bg-white">
                            <span class="font-semibold">6</span>
                        </td>
                    </tr>
                    <tr class="border border-gray-400">
                        <td class="border border-gray-400 p-3 bg-white">
                            <span class="font-semibold">84-89</span>
                        </td>
                        <td class="border border-gray-400 p-3 bg-white">
                            <span class="font-semibold">6,5</span>
                        </td>
                    </tr>
                    <tr class="border border-gray-400">
                        <td class="border border-gray-400 p-3 bg-white">
                            <span class="font-semibold">84-89</span>
                        </td>
                        <td class="border border-gray-400 p-3 bg-white">
                            <span class="font-semibold">6,5</span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <!-- Grading Summary Row -->
            <div class="mt-4 flex flex-row gap-6">
                <!-- Herkansing Box -->
                <div
                    class="border border-blue-400 rounded-lg p-4 bg-blue-50 flex items-center gap-2 shadow-sm w-fit min-w-[160px]">
                    <span class="font-semibold text-blue-700">Herkansing:</span>
                    <input wire:model.debounce.500ms="form.retry" type="checkbox" class="h-5 w-5"/>
                </div>
                <!-- Beoordeling Box -->
                <div
                    class="border border-blue-400 rounded-lg p-4 bg-blue-50 flex items-center gap-2 shadow-sm w-fit min-w-[160px]">
                    <span class="font-semibold text-blue-700">Beoordeling:</span>
                    <input wire:model.debounce.1000ms="form.finalGrade" type="number" min="0" max="10" step="0.5">
                </div>
                <!-- Ondertekening Box -->
                <div
                    class="border border-blue-400 rounded-lg p-4 bg-blue-50 flex flex-col items-center gap-2 shadow-sm w-fit min-w-[220px]">
                    <span class="font-semibold text-blue-700 mb-2">Ondertekening:</span>
                    <div class="flex flex-row gap-4">
                        <div class="flex flex-col items-center">
                            <span class="text-xs text-gray-500">Docent 1</span>
                            <div
                                class="h-12 w-24 border border-dashed border-gray-300 rounded flex items-center justify-center text-xs text-gray-400 bg-white">
                                Geen handtekening
                            </div>
                        </div>
                        <div class="flex flex-col items-center">
                            <span class="text-xs text-gray-500">Docent 2</span>
                            <div
                                class="h-12 w-24 border border-dashed border-gray-300 rounded flex items-center justify-center text-xs text-gray-400 bg-white">
                                Geen handtekening
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
