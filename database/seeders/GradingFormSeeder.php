<?php

namespace Database\Seeders;

use App\Models\CriteriaRow;
use App\Models\GradingTable;
use App\Models\KnockoutCriteria;
use App\Models\TablePointsRange;
use Illuminate\Database\Seeder;
use App\Models\GradingForm;

class GradingFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tables = [
            [
                'title' => 'Competentie Analyseren',
                'rows' => [
                    [
                        'component' => '<b>Probleemdefinitie</b>>',
                        'description' => '<b>Projectdefinitie:</b><br>• Heldere probleemstelling.<br>• Context en doelstellingen.<br>• Begrip van de organisatie en stakeholders.',
                        'insufficient' => 'Neemt deel aan teamactiviteiten en volgt aanwijzingen, maar neemt geen initiatief; interactie met teamleden is minimaal .',
                        'sufficient' => 'Probleemstelling is helder en volgt richtlijnen; basiscontext wordt benoemd.',
                        'good' => 'Complexe probleemstelling zelfstandig geformuleerd; legt duidelijke verbanden met bedrijfsprocessen en stakeholders.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                    [
                        'component' => '<b>Stakeholderanalyse</b>',
                        'description' => '<b>Projectdefinitie</b><br>• Stakeholders en hun belangen.<br>• Verwachtingen en communicatie.',
                        'insufficient' => 'Stakeholders niet of oppervlakkig benoemd; belangen en communicatie worden genegeerd.',
                        'sufficient' => 'Stakeholders worden geïdentificeerd en belangen beschreven; communicatie wordt correct uitgevoerd, maar mist proactiviteit.',
                        'good' => 'Stakeholders worden proactief betrokken, belangen diepgaand geanalyseerd; communicatie is effectief en gericht op samenwerking.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                    [
                        'component' => '<b>Data- en informatieanalyse</b>',
                        'description' => '<b>Projectdefinitie</b><br>• Analyse van verzamelde data.<br>• Methodologie.',
                        'insufficient' => 'Data-analyse is chaotisch, methodologie ontbreekt of is onjuist; resultaten zijn niet valide.',
                        'sufficient' => 'Data wordt gestructureerd verzameld en geanalyseerd volgens basisrichtlijnen; resultaten zijn valide, maar beperkt.',
                        'good' => 'Diepgaande analyse met valide methodologie; resultaten zijn helder en leggen verbanden met relevante inzichten.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                    [
                        'component' => 'Initiatief',
                        'description' => 'Toont initiatief in het werk.',
                        'insufficient' => 'Toont geen initiatief.',
                        'sufficient' => 'Toont soms initiatief.',
                        'good' => 'Toont veel initiatief.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                    [
                        'component' => 'Zelfstandigheid',
                        'description' => 'Kan zelfstandig werken.',
                        'insufficient' => 'Kan niet zelfstandig werken.',
                        'sufficient' => 'Kan redelijk zelfstandig werken.',
                        'good' => 'Werkt volledig zelfstandig.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                ],
                'description_1' => 'Beoordeling van algemene vaardigheden.',
                'description_2' => 'Let op communicatie, samenwerking, etc.',
                'deliverable_text' => 'Algemene deliverables.',
                'deliverable_checked' => false,
                'knockoutCriteria' => [
                    [
                        'text' => 'Onvoldoende op communicatie is knock-out.',
                        'checked' => false,
                    ]
                ],
                'pointRanges' => [
                    [
                        'label' => 'onvoldoende',
                        'min_points' => 0,
                        'max_points' => 11,
                    ],
                    [
                        'label' => 'voldoende',
                        'min_points' => 12,
                        'max_points' => 17,
                    ],
                    [
                        'label' => 'goed',
                        'min_points' => 18,
                        'max_points' => 25,
                    ],
                ],
            ],
            [
                'title' => 'Technische Vaardigheden',
                'rows' => [
                    [
                        'component' => 'Programmeren',
                        'description' => 'Kan code schrijven in relevante talen.',
                        'insufficient' => 'Kan geen code schrijven.',
                        'sufficient' => 'Kan eenvoudige code schrijven.',
                        'good' => 'Schrijft efficiënte en correcte code.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                    [
                        'component' => 'Debugging',
                        'description' => 'Kan fouten in code opsporen en oplossen.',
                        'insufficient' => 'Kan geen fouten vinden.',
                        'sufficient' => 'Vindt en lost eenvoudige fouten op.',
                        'good' => 'Vindt en lost complexe fouten snel op.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                    [
                        'component' => 'Versiebeheer',
                        'description' => 'Kan werken met Git.',
                        'insufficient' => 'Kan niet met versiebeheer werken.',
                        'sufficient' => 'Kan basis handelingen uitvoeren.',
                        'good' => 'Gebruikt versiebeheer optimaal.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                    [
                        'component' => 'Testen',
                        'description' => 'Kan software testen.',
                        'insufficient' => 'Test niet of nauwelijks.',
                        'sufficient' => 'Voert basis tests uit.',
                        'good' => 'Implementeert uitgebreide tests.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                    [
                        'component' => 'Documentatie',
                        'description' => 'Kan code documenteren.',
                        'insufficient' => 'Geen documentatie.',
                        'sufficient' => 'Basis documentatie aanwezig.',
                        'good' => 'Uitgebreide en duidelijke documentatie.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                ],
                'description_1' => 'Beoordeling van technische vaardigheden.',
                'description_2' => 'Let op programmeren, debugging, etc.',
                'deliverable_text' => 'Technische deliverables.',
                'deliverable_checked' => false,
                'knockoutCriteria' => [
                    [
                        'text' => 'Onvoldoende op programmeren is knock-out.',
                        'checked' => false,
                    ]
                ],
                'pointRanges' => [
                    [
                        'label' => 'onvoldoende',
                        'min_points' => 0,
                        'max_points' => 11,
                    ],
                    [
                        'label' => 'voldoende',
                        'min_points' => 12,
                        'max_points' => 17,
                    ],
                    [
                        'label' => 'goed',
                        'min_points' => 18,
                        'max_points' => 25,
                    ],
                ],
            ],
            [
                'title' => 'Projectmanagement',
                'rows' => [
                    [
                        'component' => 'Plannen',
                        'description' => 'Kan een planning maken en volgen.',
                        'insufficient' => 'Maakt geen planning.',
                        'sufficient' => 'Maakt en volgt een eenvoudige planning.',
                        'good' => 'Maakt en volgt een gedetailleerde planning.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                    [
                        'component' => 'Tijdsbewaking',
                        'description' => 'Kan tijd effectief indelen.',
                        'insufficient' => 'Verliest overzicht over tijd.',
                        'sufficient' => 'Houdt redelijk overzicht.',
                        'good' => 'Houdt uitstekend overzicht.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                    [
                        'component' => 'Prioriteiten stellen',
                        'description' => 'Kan prioriteiten bepalen.',
                        'insufficient' => 'Stelt geen prioriteiten.',
                        'sufficient' => 'Stelt basis prioriteiten.',
                        'good' => 'Stelt juiste prioriteiten.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                    [
                        'component' => 'Risicomanagement',
                        'description' => 'Kan risico\'s inschatten.',
                        'insufficient' => 'Negeert risico\'s.',
                        'sufficient' => 'Signaleert risico\'s.',
                        'good' => 'Beheerst risico\'s proactief.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                    [
                        'component' => 'Evaluatie',
                        'description' => 'Evalueert het project.',
                        'insufficient' => 'Evalueert niet.',
                        'sufficient' => 'Evalueert globaal.',
                        'good' => 'Evalueert grondig.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                ],
                'description_1' => 'Beoordeling van projectmanagement.',
                'description_2' => 'Let op planning, tijdsbewaking, etc.',
                'deliverable_text' => 'Projectmanagement deliverables.',
                'deliverable_checked' => false,
                'knockoutCriteria' => [
                    [
                        'text' => 'Onvoldoende op plannen is knock-out.',
                        'checked' => false,
                    ]
                ],
                'pointRanges' => [
                    [
                        'label' => 'onvoldoende',
                        'min_points' => 0,
                        'max_points' => 11,
                    ],
                    [
                        'label' => 'voldoende',
                        'min_points' => 12,
                        'max_points' => 17,
                    ],
                    [
                        'label' => 'goed',
                        'min_points' => 18,
                        'max_points' => 25,
                    ],
                ],
            ],
            [
                'title' => 'Klantgerichtheid',
                'rows' => [
                    [
                        'component' => 'Luisteren naar klant',
                        'description' => 'Kan klantwensen inventariseren.',
                        'insufficient' => 'Negeert klantwensen.',
                        'sufficient' => 'Inventariseert klantwensen.',
                        'good' => 'Overtreft klantverwachtingen.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                    [
                        'component' => 'Oplossingsgericht werken',
                        'description' => 'Biedt oplossingen voor klantproblemen.',
                        'insufficient' => 'Biedt geen oplossingen.',
                        'sufficient' => 'Biedt basisoplossingen.',
                        'good' => 'Biedt creatieve oplossingen.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                    [
                        'component' => 'Nazorg',
                        'description' => 'Levert goede nazorg.',
                        'insufficient' => 'Geen nazorg.',
                        'sufficient' => 'Basis nazorg.',
                        'good' => 'Uitstekende nazorg.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                    [
                        'component' => 'Communicatie met klant',
                        'description' => 'Communiceert duidelijk met klant.',
                        'insufficient' => 'Onduidelijke communicatie.',
                        'sufficient' => 'Duidelijke communicatie.',
                        'good' => 'Zeer duidelijke communicatie.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                    [
                        'component' => 'Feedback verwerken',
                        'description' => 'Kan feedback van klant verwerken.',
                        'insufficient' => 'Negeert feedback.',
                        'sufficient' => 'Verwerkt feedback.',
                        'good' => 'Gebruikt feedback om te verbeteren.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                ],
                'description_1' => 'Beoordeling van klantgerichtheid.',
                'description_2' => 'Let op luisteren, oplossingen, etc.',
                'deliverable_text' => 'Klantgerichte deliverables.',
                'deliverable_checked' => false,
                'knockoutCriteria' => [
                    [
                        'text' => 'Onvoldoende op luisteren naar klant is knock-out.',
                        'checked' => false,
                    ]
                ],
                'pointRanges' => [
                    [
                        'label' => 'onvoldoende',
                        'min_points' => 0,
                        'max_points' => 11,
                    ],
                    [
                        'label' => 'voldoende',
                        'min_points' => 12,
                        'max_points' => 17,
                    ],
                    [
                        'label' => 'goed',
                        'min_points' => 18,
                        'max_points' => 25,
                    ],
                ],
            ],
            [
                'title' => 'Creativiteit',
                'rows' => [
                    [
                        'component' => 'Innovatief denken',
                        'description' => 'Komt met nieuwe ideeën.',
                        'insufficient' => 'Geen nieuwe ideeën.',
                        'sufficient' => 'Soms nieuwe ideeën.',
                        'good' => 'Vaak innovatieve ideeën.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                    [
                        'component' => 'Problemen creatief oplossen',
                        'description' => 'Vindt creatieve oplossingen.',
                        'insufficient' => 'Geen creatieve oplossingen.',
                        'sufficient' => 'Soms creatieve oplossingen.',
                        'good' => 'Altijd creatieve oplossingen.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                    [
                        'component' => 'Out-of-the-box denken',
                        'description' => 'Denkt buiten de gebaande paden.',
                        'insufficient' => 'Denkt niet out-of-the-box.',
                        'sufficient' => 'Soms out-of-the-box.',
                        'good' => 'Vaak out-of-the-box.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                    [
                        'component' => 'Inspireren van anderen',
                        'description' => 'Inspireert collega\'s.',
                        'insufficient' => 'Inspireert niet.',
                        'sufficient' => 'Soms inspirerend.',
                        'good' => 'Vaak inspirerend.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                    [
                        'component' => 'Vernieuwing',
                        'description' => 'Draagt bij aan vernieuwing.',
                        'insufficient' => 'Geen bijdrage aan vernieuwing.',
                        'sufficient' => 'Soms bijdrage.',
                        'good' => 'Regelmatig bijdrage.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                ],
                'description_1' => 'Beoordeling van creativiteit.',
                'description_2' => 'Let op innovatie, inspiratie, etc.',
                'deliverable_text' => 'Creatieve deliverables.',
                'deliverable_checked' => false,
                'knockoutCriteria' => [
                    [
                        'text' => 'Onvoldoende op innovatief denken is knock-out.',
                        'checked' => false,
                    ]
                ],
                'pointRanges' => [
                    [
                        'label' => 'onvoldoende',
                        'min_points' => 0,
                        'max_points' => 11,
                    ],
                    [
                        'label' => 'voldoende',
                        'min_points' => 12,
                        'max_points' => 17,
                    ],
                    [
                        'label' => 'goed',
                        'min_points' => 18,
                        'max_points' => 25,
                    ],
                ],
            ],
            [
                'title' => 'Professioneel gedrag',
                'rows' => [
                    [
                        'component' => 'Op tijd komen',
                        'description' => 'Komt op tijd op afspraken.',
                        'insufficient' => 'Komt vaak te laat.',
                        'sufficient' => 'Meestal op tijd.',
                        'good' => 'Altijd op tijd.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                    [
                        'component' => 'Representativiteit',
                        'description' => 'Gedraagt zich representatief.',
                        'insufficient' => 'Niet representatief.',
                        'sufficient' => 'Meestal representatief.',
                        'good' => 'Altijd representatief.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                    [
                        'component' => 'Omgaan met feedback',
                        'description' => 'Kan goed omgaan met feedback.',
                        'insufficient' => 'Kan niet omgaan met feedback.',
                        'sufficient' => 'Gaat redelijk om met feedback.',
                        'good' => 'Gaat uitstekend om met feedback.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                    [
                        'component' => 'Verantwoordelijkheid nemen',
                        'description' => 'Neemt verantwoordelijkheid voor werk.',
                        'insufficient' => 'Neemt geen verantwoordelijkheid.',
                        'sufficient' => 'Neemt soms verantwoordelijkheid.',
                        'good' => 'Neemt altijd verantwoordelijkheid.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                    [
                        'component' => 'Ethiek',
                        'description' => 'Handelt ethisch.',
                        'insufficient' => 'Handelt niet ethisch.',
                        'sufficient' => 'Meestal ethisch.',
                        'good' => 'Altijd ethisch.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                ],
                'description_1' => 'Beoordeling van professioneel gedrag.',
                'description_2' => 'Let op punctualiteit, ethiek, etc.',
                'deliverable_text' => 'Professionele deliverables.',
                'deliverable_checked' => false,
                'knockoutCriteria' => [
                    [
                        'text' => 'Onvoldoende op op tijd komen is knock-out.',
                        'checked' => false,
                    ]
                ],
                'pointRanges' => [
                    [
                        'label' => 'onvoldoende',
                        'min_points' => 0,
                        'max_points' => 11,
                    ],
                    [
                        'label' => 'voldoende',
                        'min_points' => 12,
                        'max_points' => 17,
                    ],
                    [
                        'label' => 'goed',
                        'min_points' => 18,
                        'max_points' => 25,
                    ],
                ],
            ],
        ];

        $form = GradingForm::create([
            'title' => 'Beoordelingsformulier Comakership',
            'student_name' => '',
            'student_number' => '',
            'company_name' => '',
            'company_place' => '',
            'start_period' => '',
            'end_period' => '',
            'oe_code' => '',
            'title_assignment' => '',
            'retry' => false,
            'grading_date' => '',
        ]);

        foreach ($tables as $table) {
            $gradingTable = GradingTable::create([
                'title' => $table['title'],
                'grading_form_id' => $form->id,
                'description_1' => $table['description_1'],
                'description_2' => $table['description_2'],
                'deliverable_text' => $table['deliverable_text'],
                'deliverable_checked' => $table['deliverable_checked'],
                'max_points' => 25,
                'min_points' => 12,
            ]);

            foreach ($table['rows'] as $order => $row) {
                CriteriaRow::create([
                    'grading_table_id' => $gradingTable->id,
                    'component' => $row['component'],
                    'description' => $row['description'],
                    'insufficient' => $row['insufficient'],
                    'sufficient' => $row['sufficient'],
                    'good' => $row['good'],
                    'points' => $row['points'],
                    'remarks' => $row['remarks'],
                    'order' => $order,
                ]);
            }

            foreach ($table['knockoutCriteria'] as $order => $knockout) {
                KnockoutCriteria::create([
                    'grading_table_id' => $gradingTable->id,
                    'text' => $knockout['text'],
                    'checked' => $knockout['checked'],
                    'order' => $order,
                ]);
            }

            if (isset($table['pointRanges'])) {
                foreach ($table['pointRanges'] as $order => $range) {
                    TablePointsRange::create([
                        'grading_table_id' => $gradingTable->id,
                        'label' => $range['label'],
                        'min_points' => $range['min_points'],
                        'max_points' => $range['max_points'],
                    ]);
                }
            }
        }
    }
}
