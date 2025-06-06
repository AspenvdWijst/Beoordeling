<x-layouts.app :title="__('grade')">
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-50">
        <div class="w-full px-2 py-4">
            <div class="bg-white rounded-lg shadow p-4">
                <div class="mb-6 text-center">
                    <span class="font-bold text-2xl">{{ $form['title'] ?? 'Beoordelingsformulier' }}</span>
                </div>

                <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
                    <div class="grid gap-4 md:grid-cols-2">
                        <div
                            class="border border-neutral-200 dark:border-neutral-700 overflow-x-auto bg-white dark:bg-neutral-800">
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
                                    <td class="border border-gray-400 p-3 bg-white font-semibold">Studentnaam:</td>
                                    <td class="border border-gray-400 p-3 bg-white">
                                        {{ $form['student_name'] ?? '-' }}
                                    </td>
                                </tr>
                                <tr class="border border-gray-400">
                                    <td class="border border-gray-400 p-3 bg-white font-semibold">Studentnummer:
                                    </td>
                                    <td class="border border-gray-400 p-3 bg-white">
                                        {{ $form['student_number'] ?? '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-400 p-3 bg-white font-semibold">Datum
                                        beoordeling:
                                    </td>
                                    <td class="border border-gray-400 p-3 bg-white">
                                        {{ $form['grading_date'] ?? '-' }}
                                    </td>
                                </tr>
                                <tr class="border border-gray-400">
                                    <td class="border border-gray-400 p-3 bg-white font-semibold">OE-code:</td>
                                    <td class="border border-gray-400 p-3 bg-white">
                                        {{ $form['oe_code'] ?? '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-400 p-3 bg-white font-semibold">Datum aanvang
                                        Comaker en einddatum:
                                    </td>
                                    <td class="border border-gray-400 p-3 bg-white">
                                        {{ $form['start_period'] ?? '-' }} <span
                                            class="font-semibold">tot</span> {{ $form['end_period'] ?? '-' }}
                                    </td>
                                </tr>
                                <tr class="border border-gray-400">
                                    <td class="border border-gray-400 p-3 bg-white font-semibold">Titel opdracht:
                                    </td>
                                    <td class="border border-gray-400 p-3 bg-white">
                                        {{ $form['title_assignment'] ?? '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-400 p-3 bg-white font-semibold">Bedrijfsnaam en
                                        -plaats:
                                    </td>
                                    <td class="border border-gray-400 p-3 bg-white">
                                        {{ $form['company_name'] ?? '-' }} <span
                                            class="font-semibold">te</span> {{ $form['company_place'] ?? '-' }}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div
                            class="border border-neutral-200 dark:border-neutral-700 overflow-x-auto bg-white dark:bg-neutral-800">
                            <table class="table-auto min-w-full border border-gray-400">
                                <thead>
                                <tr>
                                    <th class="bg-blue-400 text-white text-lg py-3 text-center border border-gray-400">
                                        Eindbeoordeling
                                    </th>
                                    <th class="bg-blue-400 text-white text-lg py-3 text-center border border-gray-400">
                                        Totaal te behalen punten:
                                    </th>
                                    <th class="bg-blue-400 text-white text-lg py-3 text-center border border-gray-400">
                                        Behaald
                                    </th>
                                    <th class="bg-blue-400 text-white text-lg py-3 text-center border border-gray-400">
                                        Minimale punten eis
                                    </th>
                                    <th class="bg-blue-400 text-white text-lg py-3 text-center border border-gray-400">
                                        Punten range
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($form['tables'] as $tableIndex => $table)
                                    <tr class="border border-gray-400">
                                        <td class="border border-gray-400 p-3 bg-white font-semibold">{{ $table['title'] }}</td>
                                        <td class="border border-gray-400 p-3 bg-white">{{ $table['max_points'] }}</td>
                                        <td class="border border-gray-400 p-3 bg-orange-300 text-right font-bold">
                                            {{ array_sum(array_column($table['criteria_rows'], 'points')) }}
                                        </td>
                                        <td class="border border-gray-400 p-3 bg-white">{{ $table['min_points'] }}</td>
                                        <td class="border border-gray-400 p-3 bg-white">
                                            @if(isset($table['point_ranges']) && is_array($table['point_ranges']))
                                                @foreach($table['point_ranges'] as $range)
                                                    <div>
                                                        <span
                                                            class="font-semibold">{{ ucfirst($range['label']) }}:</span>
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
                                    <td class="border border-gray-400 bg-white text-right font-bold">{{ $maxObtainablePoints ?? '-' }}</td>
                                    <td class="border border-gray-400 p-3 bg-white text-right font-bold">{{ $grandTotal ?? '-' }}</td>
                                    <td class="border border-gray-400 p-3 bg-white text-right font-bold">{{ $minObtainablePoints ?? '-' }}</td>
                                    <td class="border border-gray-400 p-3 bg-white"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div
                        class="border border-neutral-200 dark:border-neutral-700 overflow-x-auto bg-white dark:bg-neutral-800">
                        <table class="table-auto min-w-full border border-gray-400">
                            <thead>
                            <tr>
                                <th colspan="6"
                                    class="bg-blue-400 text-white text-lg py-3 text-center border border-gray-400">
                                    Competentieprofiel en niveaus
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="border border-gray-400">
                                <td class="border border-gray-400 p-3 bg-white font-semibold">Activiteit</td>
                                <td class="border border-gray-400 p-3 bg-white font-semibold">Analyseren</td>
                                <td class="border border-gray-400 p-3 bg-white font-semibold">Adviseren</td>
                                <td class="border border-gray-400 p-3 bg-white font-semibold">Ontwerpen</td>
                                <td class="border border-gray-400 p-3 bg-white font-semibold">Realiseren</td>
                                <td class="border border-gray-400 p-3 bg-white font-semibold">Manage & control</td>
                            </tr>
                            <tr class="border border-gray-400">
                                <td class="border border-gray-400 p-3 bg-white">Gebruikersinteractie</td>
                                <td colspan="5" class="border border-gray-400 p-3 bg-white"></td>
                            </tr>
                            <tr class="border border-gray-400">
                                <td class="border border-gray-400 p-3 bg-white">Organisatieprocessen</td>
                                <td colspan="5" class="border border-gray-400 p-3 bg-white"></td>
                            </tr>
                            <tr class="border border-gray-400">
                                <td class="border border-gray-400 p-3 bg-white">Infrastructuur</td>
                                <td colspan="5" class="border border-gray-400 p-3 bg-white"></td>
                            </tr>
                            <tr class="border border-gray-400">
                                <td class="border border-gray-400 p-3 bg-blue-400 text-white font-semibold">Software
                                </td>
                                <td class="border border-gray-400 p-3 bg-blue-400 text-white text-center font-semibold">
                                    {{ $form['software']['analyse'] }}
                                </td>
                                <td class="border border-gray-400 p-3 bg-blue-400 text-white text-center font-semibold">
                                    {{ $form['software']['advise'] }}
                                </td>
                                <td class="border border-gray-400 p-3 bg-blue-400 text-white text-center font-semibold">
                                    {{ $form['software']['design'] }}
                                </td>
                                <td class="border border-gray-400 p-3 bg-blue-400 text-white text-center font-semibold">
                                    {{ $form['software']['realise'] }}
                                </td>
                                <td class="border border-gray-400 p-3 bg-blue-400 text-white text-center font-semibold">
                                    {{ $form['software']['manage'] }}
                                </td>
                            </tr>
                            <tr class="border border-gray-400">
                                <td class="border border-gray-400 p-3 bg-white">Hardware interfacing</td>
                                <td colspan="5" class="border border-gray-400 p-3 bg-white"></td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="grid auto-rows-min gap-4 md:grid-cols-2 mt-6">
                            <div
                                class="relative h-full flex-1 overflow-hidden border border-neutral-200 dark:border-neutral-700">
                                <table class="table-auto min-w-full border border-gray-400">
                                    <thead>
                                    <tr>
                                        <th colspan="6"
                                            class="bg-blue-400 text-white text-lg py-3 text-center border border-gray-400">
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
                            <div class="mt-4 flex flex-row gap-6">
                                <div class="flex flex-col justify-center items-center bg-white rounded-xl px-6 py-4 shadow transition hover:shadow-md border border-gray-200 min-w-[160px]">
                                    <div class="flex items-center gap-2 mb-2">
                                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3"/>
                                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"/>
                                        </svg>
                                        <span class="font-semibold text-blue-700 text-base">Herkansing</span>
                                    </div>
                                    <span class="text-lg font-bold {{ !empty($form['retry']) ? 'text-green-600' : 'text-red-500' }}">
                                        @if(!empty($form['retry']))
                                            <svg class="inline w-6 h-6 text-green-500" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            Ja
                                        @else
                                            <svg class="inline w-6 h-6 text-red-500" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                            Nee
                                        @endif
                                    </span>
                                </div>
                                <div class="flex flex-col items-center justify-center bg-white rounded-xl px-6 py-4 shadow transition hover:shadow-md border border-gray-200 min-w-[160px]">
                                    <div class="flex items-center gap-2 mb-2">
                                        <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 17l-5 3 1.9-5.6L4 9.5l5.7-.4L12 4l2.3 5.1 5.7.4-4.9 4.9L17 20z"/>
                                        </svg>
                                        <span class="font-semibold text-yellow-700 text-base">Beoordeling</span>
                                    </div>
                                    <span class="text-2xl font-extrabold">
                                        {{ $form['finalGrade'] ?? '-' }}
{{--                                        {{ $grade->grade }}--}}
                                    </span>
                                </div>
                                <div class="flex flex-col justify-center items-center gap-2 shadow-sm w-fit min-w-[220px] bg-white rounded-xl px-6 py-4 border border-gray-200">
                                    <span class="font-semibold text-gray-700 mb-2 text-base">Ondertekening</span>
                                    <div class="flex flex-col space-y-4">
                                        @foreach($form['assignment']['teachers'] ?? [] as $teacher)
                                            <div class="flex flex-col items-center bg-gray-50 rounded-xl px-4 py-3 shadow transition hover:shadow-md">
                                                <div class="mb-2 flex items-center justify-center w-12 h-12 rounded-full bg-gradient-to-br from-green-400 to-blue-400 text-white text-lg font-bold shadow-inner">
                                                    {{ strtoupper(substr($teacher['name'], 0, 1)) }}
                                                </div>
                                                <span class="text-sm font-medium text-gray-800 mb-1">{{ $teacher['name'] ?? '-' }}</span>
                                                <div class="flex items-center gap-1 mt-1 px-2 py-1 bg-green-100 border border-green-400 rounded-full text-green-700 font-semibold text-xs shadow">
                                                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                                    </svg>
                                                    Goedgekeurd
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="flex flex-col gap-6 mt-6">
                    @foreach($form['tables'] as $table)
                        @if(isset($table['criteria_rows']) && count($table['criteria_rows']))
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <span class="font-bold text-lg">{{ $table['title'] ?? 'Geen titel' }}</span>
                                </div>
                                <div class="overflow-x-auto">
                                    <table class="min-w-full border border-gray-300 rounded-lg text-xs sm:text-sm">
                                        <thead>
                                        <tr>
                                            <th colspan="2" class="bg-blue-100 p-2 text-center border border-gray-300">
                                                Verwachte componenten in deliverables
                                            </th>
                                            <th class="bg-orange-100 p-2 text-center border border-gray-300">
                                                Onvoldoende (0 punten)
                                            </th>
                                            <th class="bg-green-200 p-2 text-center border border-gray-300">
                                                Voldoende (3 punten)
                                            </th>
                                            <th class="bg-green-300 p-2 text-center border border-gray-300">
                                                Goed (5 punten)
                                            </th>
                                            <th class="bg-blue-200 p-2 text-center border border-gray-300 w-20">
                                                Punten
                                            </th>
                                            <th class="bg-blue-200 p-2 text-center border border-gray-300">
                                                Opmerking
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($table['criteria_rows'] as $row)
                                            <tr>
                                                <td class="border border-gray-300 p-2 bg-gray-100 font-bold">
                                                    {!! $row['component'] !!}
                                                </td>
                                                <td class="border border-gray-300 p-2">
                                                    {!! $row['description'] !!}
                                                </td>
                                                <td class="border border-gray-300 p-2 text-center {{ isset($row['points']) && $row['points'] === 0 ? 'bg-orange-100 font-bold' : '' }}">
                                                    {{ $row['insufficient'] }}
                                                </td>
                                                <td class="border border-gray-300 p-2 text-center {{ isset($row['points']) && $row['points'] === 3 ? 'bg-green-200 font-bold' : '' }}">
                                                    {{ $row['sufficient'] }}
                                                </td>
                                                <td class="border border-gray-300 p-2 text-center {{ isset($row['points']) && $row['points'] === 5 ? 'bg-green-300 font-bold' : '' }}">
                                                    {{ $row['good'] }}
                                                </td>
                                                <td class="border border-gray-300 p-2 text-center">
                                                    {{ $row['points'] ?? '' }}
                                                </td>
                                                <td class="border border-gray-300 p-2">
                                                    {{ $row['remarks'] ?? '' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="5" class="border border-gray-300 p-2 text-right font-semibold">
                                                Totaal behaalde punten
                                            </td>
                                            <td class="border border-gray-300 p-2 text-center bg-blue-100 font-bold">
                                                {{ array_sum(array_column($table['criteria_rows'], 'points')) }}
                                            </td>
                                            <td class="border border-gray-300 p-2 bg-blue-100"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="border border-gray-300 p-2">
                                                {{ $table['description_1'] ?? '' }}
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
                                                </div>
                                                <hr class="border-black my-3">
                                                @if(isset($table['knockoutcriteria']))
                                                    @foreach($table['knockoutcriteria'] as $criteria)
                                                        <div class="flex items-center justify-between mb-3 last:mb-0">
                                                            <span>{{ $criteria['text'] ?? '' }}</span>
                                                            <span>
                                                                @if(!empty($criteria['checked']))
                                                                    &#10003;
                                                                @else
                                                                    &#10007;
                                                                @endif
                                                            </span>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="7" class="border border-gray-300 p-2">
                                                {{ $table['description_2'] ?? '' }}
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
