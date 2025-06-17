<head>
    <style>
        body {
            background: #f9fafb;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 24px 8px;
        }

        .card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            padding: 24px;
            margin-bottom: 24px;
        }

        .title {
            font-weight: bold;
            font-size: 2rem;
            text-align: center;
            margin-bottom: 24px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 16px;
            font-size: 0.95rem;
        }

        th,
        td {
            border: 1px solid #cbd5e1;
            padding: 8px 6px;
            background: #fff;
        }

        th {
            background: #60a5fa;
            color: #fff;
            font-weight: bold;
        }

        .sub-th {
            background: #e0e7ef;
            color: #222;
        }

        .highlight {
            background: #fde68a;
            font-weight: bold;
        }

        .success {
            color: #16a34a;
            font-weight: bold;
        }

        .fail {
            color: #dc2626;
            font-weight: bold;
        }

        .section-title {
            font-weight: bold;
            font-size: 1.1rem;
            margin: 16px 0 8px 0;
        }

        .signature-box {
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 12px 16px;
            margin-bottom: 8px;
            background: #f3f4f6;
        }

        .flex-row {
            display: flex;
            flex-direction: row;
            gap: 16px;
        }

        .flex-col {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .center {
            text-align: center;
        }

        .rounded {
            border-radius: 8px;
        }

        .shadow {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .mb-2 {
            margin-bottom: 8px;
        }

        .mb-3 {
            margin-bottom: 12px;
        }

        .mb-4 {
            margin-bottom: 16px;
        }

        .mt-4 {
            margin-top: 16px;
        }

        .mt-6 {
            margin-top: 24px;
        }

        .w-20 {
            width: 80px;
        }

        .font-bold {
            font-weight: bold;
        }

        .font-semibold {
            font-weight: 600;
        }

        .font-extrabold {
            font-weight: 800;
        }

        .text-lg {
            font-size: 1.125rem;
        }

        .text-base {
            font-size: 1rem;
        }

        .text-sm {
            font-size: 0.875rem;
        }

        .text-xs {
            font-size: 0.75rem;
        }

        .text-green {
            color: #16a34a;
        }

        .text-red {
            color: #dc2626;
        }

        .text-blue {
            color: #2563eb;
        }

        .bg-blue {
            background: #60a5fa;
        }

        .bg-green {
            background: #bbf7d0;
        }

        .bg-orange {
            background: #fdba74;
        }

        .bg-gray {
            background: #f3f4f6;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <div class="title">{{ $form['title'] ?? 'Beoordelingsformulier' }}</div>
        <div class="flex-row mb-4">
            <div style="flex:1;">
                <table>
                    <thead>
                    <tr>
                        <th colspan="2">Gegevens</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="font-semibold">Studentnaam:</td>
                        <td>{{ $form['student_name'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold">Studentnummer:</td>
                        <td>{{ $form['student_number'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold">Datum beoordeling:</td>
                        <td>{{ $form['grading_date'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold">OE-code:</td>
                        <td>{{ $form['oe_code'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold">Datum aanvang Comaker en einddatum:</td>
                        <td>{{ $form['start_period'] ?? '-' }} <span class="font-semibold">tot</span> {{ $form['end_period'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold">Titel opdracht:</td>
                        <td>{{ $form['title_assignment'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold">Bedrijfsnaam en -plaats:</td>
                        <td>{{ $form['company_name'] ?? '-' }} <span class="font-semibold">te</span> {{ $form['company_place'] ?? '-' }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div style="flex:2;">
                <table>
                    <thead>
                    <tr>
                        <th>Eindbeoordeling</th>
                        <th>Totaal te behalen punten:</th>
                        <th>Behaald</th>
                        <th>Minimale punten eis</th>
                        <th>Punten range</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($form['tables'] as $tableIndex => $table)
                        <tr>
                            <td class="font-semibold">{{ $table['title'] }}</td>
                            <td>{{ $table['max_points'] }}</td>
                            <td class="bg-orange text-right font-bold">{{ array_sum(array_column($table['criteria_rows'], 'points')) }}</td>
                            <td>{{ $table['min_points'] }}</td>
                            <td>
                                @if(isset($table['point_ranges']) && is_array($table['point_ranges']))
                                    @foreach($table['point_ranges'] as $range)
                                        <div><span class="font-semibold">{{ ucfirst($range['label']) }}:</span> <span>{{ $range['min_points'] }} - {{ $range['max_points'] }}</span></div>
                                    @endforeach
                                @else
                                    <span style="color:#888;">Geen ranges</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td class="text-right font-bold">{{ $maxObtainablePoints ?? '-' }}</td>
                        <td class="text-right font-bold">{{ $grandTotal ?? '-' }}</td>
                        <td class="text-right font-bold">{{ $minObtainablePoints ?? '-' }}</td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mb-4">
            <table>
                <thead>
                <tr>
                    <th colspan="6">Competentieprofiel en niveaus</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="font-semibold">Activiteit</td>
                    <td class="font-semibold">Analyseren</td>
                    <td class="font-semibold">Adviseren</td>
                    <td class="font-semibold">Ontwerpen</td>
                    <td class="font-semibold">Realiseren</td>
                    <td class="font-semibold">Manage & control</td>
                </tr>
                <tr>
                    <td>Gebruikersinteractie</td>
                    <td colspan="5"></td>
                </tr>
                <tr>
                    <td>Organisatieprocessen</td>
                    <td colspan="5"></td>
                </tr>
                <tr>
                    <td>Infrastructuur</td>
                    <td colspan="5"></td>
                </tr>
                <tr>
                    <td class="bg-blue font-semibold text-white">Software</td>
                    <td class="bg-blue font-semibold center">{{ $form['software']['analyse'] }}</td>
                    <td class="bg-blue font-semibold center">{{ $form['software']['advise'] }}</td>
                    <td class="bg-blue font-semibold center">{{ $form['software']['design'] }}</td>
                    <td class="bg-blue font-semibold center">{{ $form['software']['realise'] }}</td>
                    <td class="bg-blue font-semibold center">{{ $form['software']['manage'] }}</td>
                </tr>
                <tr>
                    <td>Hardware interfacing</td>
                    <td colspan="5"></td>
                </tr>
                </tbody>
            </table>
            <div class="flex-row mt-4">
                <div style="flex:1;">
                    <table>
                        <thead>
                        <tr>
                            <th colspan="2">Punten omzetten naar cijfer</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><span class="font-semibold">72-79</span></td>
                            <td><span class="font-semibold">5.5</span></td>
                        </tr>
                        <tr>
                            <td><span class="font-semibold">80-89</span></td>
                            <td><span class="font-semibold">6</span></td>
                        </tr>
                        <tr>
                            <td><span class="font-semibold">90-97</span></td>
                            <td><span class="font-semibold">6.5</span></td>
                        </tr>
                        <tr>
                            <td><span class="font-semibold">98-105</span></td>
                            <td><span class="font-semibold">7</span></td>
                        </tr>
                        <tr>
                            <td><span class="font-semibold">106-114</span></td>
                            <td><span class="font-semibold">7.5</span></td>
                        </tr>
                        <tr>
                            <td><span class="font-semibold">115-123</span></td>
                            <td><span class="font-semibold">8</span></td>
                        </tr>
                        <tr>
                            <td><span class="font-semibold">124-131</span></td>
                            <td><span class="font-semibold">8.5</span></td>
                        </tr>
                        <tr>
                            <td><span class="font-semibold">132-140</span></td>
                            <td><span class="font-semibold">9</span></td>
                        </tr>
                        <tr>
                            <td><span class="font-semibold">141-148</span></td>
                            <td><span class="font-semibold">9.5</span></td>
                        </tr>
                        <tr>
                            <td><span class="font-semibold">149-150</span></td>
                            <td><span class="font-semibold">10</span></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div style="flex:2;" class="flex-row gap-6">
                    <div class="signature-box center">
                        <div class="mb-2"><span class="font-semibold text-blue">Herkansing</span>
                        </div>
                        <span class="text-lg font-bold {{ !empty($form['retry']) ? 'text-green' : 'text-red' }}">
                            @if(!empty($form['retry']))
                                <span class="success">✓</span>
                            @else
                                <span class="fail">✗</span>
                            @endif
                        </span>
                    </div>
                    <div class="signature-box center">
                        <div class="mb-2"><span class="font-semibold text-yellow-700">Beoordeling</span>
                        </div>
                        <span class="text-2xl font-extrabold">{{ $form['finalGrade'] ?? '-' }}</span>
                    </div>
                    <div class="signature-box flex-col">
                        <span class="font-semibold mb-2 text-base">Ondertekening</span>
                        @foreach($form['assignment']['teachers'] ?? [] as $teacher)
                            <div class="flex-row center mb-2">
                                <div style="width:36px;height:36px;line-height:36px;background:linear-gradient(135deg,#4ade80,#60a5fa);color:#fff;font-weight:bold;border-radius:50%;text-align:center;">{{ strtoupper(substr($teacher['name'], 0, 1)) }}</div>
                                <span class="text-sm font-medium ml-2">{{ $teacher['name'] ?? '-' }}</span>
                                <span class="success ml-2">✓ Goedgekeurd</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="flex-col gap-6 mt-6">
            @foreach($form['tables'] as $table)
                @if(isset($table['criteria_rows']) && count($table['criteria_rows']))
                    <div>
                        <div class="section-title">{{ $table['title'] ?? 'Geen titel' }}</div>
                        <table>
                            <thead>
                            <tr>
                                <th colspan="2" class="sub-th">Verwachte componenten in deliverables</th>
                                <th class="sub-th">Onvoldoende (0 punten)</th>
                                <th class="sub-th">Voldoende (3 punten)</th>
                                <th class="sub-th">Goed (5 punten)</th>
                                <th class="sub-th w-20">Punten</th>
                                <th class="sub-th">Opmerking</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($table['criteria_rows'] as $row)
                                <tr>
                                    <td class="bg-gray font-bold">{!! $row['component'] !!}</td>
                                    <td>{!! $row['description'] !!}</td>
                                    <td class="center {{ isset($row['points']) && $row['points'] === 0 ? 'highlight' : '' }}">{{ $row['insufficient'] }}</td>
                                    <td class="center {{ isset($row['points']) && $row['points'] === 3 ? 'bg-green' : '' }}">{{ $row['sufficient'] }}</td>
                                    <td class="center {{ isset($row['points']) && $row['points'] === 5 ? 'bg-green font-bold' : '' }}">{{ $row['good'] }}</td>
                                    <td class="center">{{ $row['points'] ?? '' }}</td>
                                    <td>{{ $row['remarks'] ?? '' }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="5" class="text-right font-semibold">Totaal behaalde punten</td>
                                <td class="center highlight">{{ array_sum(array_column($table['criteria_rows'], 'points')) }}</td>
                                <td class="bg-gray"></td>
                            </tr>
                            <tr>
                                <td colspan="3">{!! $table['description_1'] ?? '' !!}</td>
                                <td colspan="4">
                                    <div class="flex-row mb-3">
                                        <span>{{ $table['deliverable_text'] ?? '' }}</span>
                                        <span>
                                            @if(!empty($table['deliverable_checked']))
                                                &#10003;
                                            @else
                                                &#10007;
                                            @endif
                                        </span>
                                    </div>
                                    <hr style="border:1px solid #000; margin:8px 0;">
                                    @if(isset($table['knockoutcriteria']))
                                        @foreach($table['knockoutcriteria'] as $criteria)
                                            <div class="flex-row mb-3">
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
                                <td colspan="7">{!! $table['description_2'] ?? '' !!}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
</body>
