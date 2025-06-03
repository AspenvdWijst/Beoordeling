<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
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
                        <span class="font-bold">0</span>
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
                                <input wire:model="tables.{{ $tableIndex }}.pointRanges.{{ $index }}.min_points"
                                       type="number" min="0" max="25" class="border rounded px-2 py-1 w-16 @error('tables.' . $tableIndex . '.pointRanges' . $index . '.min_points') border-red-500 bg-red-50 @enderror"
                                       placeholder="Min">
                                <span>-</span>
                                <input wire:model="tables.{{ $tableIndex }}.pointRanges.{{ $index }}.max_points"
                                       type="number" min="0" max="25" class="border rounded px-2 py-1 w-16 @error('tables.' . $tableIndex . '.pointRanges' . $index . '.max_points') border-red-500 bg-red-50 @enderror"
                                       placeholder="Max">
                                <input type="hidden"
                                       wire:model="tables.{{ $tableIndex }}.pointRanges.{{ $index }}.label"
                                       value="{{ $label }}">
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
                    <span class="font-bold">0</span>
                </td>
                <td class="border border-gray-400 p-3 bg-white text-right">
                    <span class="font-bold">{{ $minObtainablePoints }}</span>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
