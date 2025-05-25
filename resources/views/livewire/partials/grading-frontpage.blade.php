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
                            <div class="flex items-center justify-between gap-2">
                                <label for="studentName" class="font-semibold mb-0">Studentnaam:</label>
                                <input wire:model="student.name" type="text" id="studentName" name="studentName" placeholder="<naam student>"
                                       class="border border-gray-300 rounded px-2 py-1 w-2/3">
                            </div>
                        </td>
                        <td class="border border-gray-400 p-3 bg-white">
                            <div class="flex items-center justify-between gap-2">
                                <label for="retry" class="font-semibold mb-0">Herkansing:</label>
                                <input wire:model="retry" type="checkbox" id="retry" name="retry"
                                       class="h-5 w-5">
                            </div>
                        </td>
                    </tr>
                    <tr class="border border-gray-400">
                        <td class="border border-gray-400 p-3 bg-white">
                            <div class="flex items-center justify-between gap-2">
                                <label for="studentNumber" class="font-semibold mb-0">Studentnummer:</label>
                                <input wire:model="student.number" type="text" id="studentNumber" name="studentNumber" placeholder="<studentnummer>"
                                       class="border border-gray-300 rounded px-2 py-1 w-2/3">
                            </div>
                        </td>
                        <td class="border border-gray-400 p-3 bg-white">
                            <div class="flex items-center justify-between gap-2">
                                <label for="gradingDate" class="font-semibold mb-0">Datum beoordeling:</label>
                                <input wire:model="gradingDate" type="date" id="gradingDate" name="gradingDate"
                                       class="border border-gray-300 rounded px-2 py-1 w-2/3">
                            </div>
                        </td>
                    </tr>
                    <tr class="border border-gray-400">
                        <td class="border border-gray-400 p-3 bg-white">
                            <div class="flex items-center justify-between gap-2">
                                <label for="oeCode" class="font-semibold mb-0">OE-code:</label>
                                <input wire:model="OEcode" type="text" id="oeCode" name="oeCode" placeholder="<OE-code>"
                                       class="border border-gray-300 rounded px-2 py-1 w-2/3">
                            </div>
                        </td>
                        <td class="border border-gray-400 p-3 bg-white">
                            <div class="flex items-center justify-between gap-2">
                                <label for="startPeriod" class="font-semibold mb-0">Periode:</label>
                                <input wire:model="period.start" type="date" id="startPeriod" name="startPeriod"
                                       class="border border-gray-300 rounded px-2 py-1 w-20">
                                <span class="font-semibold mb-0">tot</span>
                                <input wire:model="period.end" type="date" id="endPeriod" name="endPeriod"
                                       class="border border-gray-300 rounded px-2 py-1 w-20">
                            </div>
                        </td>
                    </tr>
                    <tr class="border border-gray-400">
                        <td class="border border-gray-400 p-3 bg-white">
                            <div class="flex items-center justify-between gap-2">
                                <label for="titleAssignment" class="font-semibold mb-0">Titel opdracht:</label>
                                <input wire:model="titleAssignment" type="text" id="titleAssignment" name="titleAssignment" placeholder="<titel>"
                                       class="border border-gray-300 rounded px-2 py-1 w-2/3">
                            </div>
                        </td>
                        <td class="border border-gray-400 p-3 bg-white">
                            <div class="flex items-center justify-between gap-2">
                                <label for="companyName" class="font-semibold mb-0">Bedrijfsnaam en -plaats:</label>
                                <input wire:model="company.name" type="text" id="companyName" name="companyName" placeholder="<bedrijfsnaam>"
                                       class="border border-gray-300 rounded px-2 py-1 w-20">
                                <span class="font-semibold mb-0">te</span>
                                <input wire:model="company.place" type="text" id="companyPlace" name="companyPlace" placeholder="<plaats>"
                                       class="border border-gray-300 rounded px-2 py-1 w-20">
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div
            class="relative aspect-video overflow-x-auto border-neutral-200 dark:border-neutral-700">
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
                @foreach($tables as $tableIndex => $table)
                    <tr class="border border-gray-400">
                        <td class="border border-gray-400 p-3 bg-white">
                            <label for="naam" class="block font-semibold mb-1">{{ $table['title'] }}</label>
                        </td>
                        <td class="border border-gray-400 p-3 bg-white">
                            <input type="number"
                                   wire:model="tables.{{ $tableIndex }}.maxObtainablePoints"
                                   class="w-full border border-gray-300 rounded px-2 py-1">
                        </td>
                        <td class="border border-gray-400 p-3 bg-orange-300 text-right">
                            <span class="font-bold">{{ $this->getTotalPoints($tableIndex) }}</span>
                        </td>
                        <td class="border border-gray-400 p-3 bg-white">
                            <input type="number"
                                   wire:model="tables.{{ $tableIndex }}.minObtainablePoints"
                                   class="w-full border border-gray-300 rounded px-2 py-1">
                        </td>
                        <td class="border border-gray-400 p-3 bg-white">
                            @foreach($labels as $index => $label)
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="w-24 capitalize">{{ $label }}:</span>
                                    <input wire:model="tables.{{ $tableIndex }}.pointRanges.{{ $index }}.min_points" type="number" min="0" max="25" class="border rounded px-2 py-1 w-16" placeholder="Min">
                                    <span>-</span>
                                    <input wire:model="tables.{{ $tableIndex }}.pointRanges.{{ $index }}.max_points" type="number" min="0" max="25" class="border rounded px-2 py-1 w-16" placeholder="Max">
                                    <input type="hidden" wire:model="tables.{{ $tableIndex }}.pointRanges.{{ $index }}.label" value="{{ $label }}">
                                </div>
                            @endforeach
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
</div>
