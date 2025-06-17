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
                        'description' => '<b>Projectdefinitie:</b><br>• Stakeholders en hun belangen.<br>• Verwachtingen en communicatie.',
                        'insufficient' => 'Stakeholders niet of oppervlakkig benoemd; belangen en communicatie worden genegeerd.',
                        'sufficient' => 'Stakeholders worden geïdentificeerd en belangen beschreven; communicatie wordt correct uitgevoerd, maar mist proactiviteit.',
                        'good' => 'Stakeholders worden proactief betrokken, belangen diepgaand geanalyseerd; communicatie is effectief en gericht op samenwerking.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                    [
                        'component' => '<b>Data- en informatieanalyse</b>',
                        'description' => '<b>Projectdefinitie:</b><br>• Analyse van verzamelde data.<br>• Methodologie.',
                        'insufficient' => 'Data-analyse is chaotisch, methodologie ontbreekt of is onjuist; resultaten zijn niet valide.',
                        'sufficient' => 'Data wordt gestructureerd verzameld en geanalyseerd volgens basisrichtlijnen; resultaten zijn valide, maar beperkt.',
                        'good' => 'Diepgaande analyse met valide methodologie; resultaten zijn helder en leggen verbanden met relevante inzichten.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                    [
                        'component' => '<b>Gebruik van technieken</b>',
                        'description' => '<b>Plan van Aanpak / Onderzoeksrapport:</b><br>• Toepassing van analysetechnieken.<br>• Beschrijving van gekozen tools en methodes.',
                        'insufficient' => 'Technieken zijn onjuist of incosistent toegepast; geen verantwoording van keuzes.',
                        'sufficient' => 'Technieken worden correct toegepast volgens standaardrichtlijnen; keuzes zijn kort verantwoord.',
                        'good' => 'Zelfstandig geselecteerde technieken; keuzes zijn onderbouwd en leiden tot relevante en nauwkeurige resultaten.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                    [
                        'component' => '<b>Conclusies en aanbevelingen</b>',
                        'description' => '<b>Onderzoeksrapport:</b><br>• Logische conlusies.<br>• Onderbouwde aanbevelingen.<br>• Impact op organisatie en stakeholders.',
                        'insufficient' => 'Conclusies missen onderbouwing of zijn inconsistent; aanbevelingen zijn onpraktisch of algemeen.',
                        'sufficient' => 'Conclusies en aanbevelingen zijn logisch en correct, maar missen soms diepgang of praktische relevantie.',
                        'good' => 'Conclusies zijn goed onderbouwd; aanbevelingen zijn praktisch toepasbaar en bieden duidelijke meerwaarde voor de organisatie.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                ],
                'description_1' => '<b>Beoordelingsschaal</b><br>• <b>Onvoldoende</b>: Basale onderdelen ontbreken of zijn onjuist uitgevoerd; voldoet niet aan het vereiste niveau.<br>• <b>Voldoende</b>: Basisniveau is gehaald; werk is correct, maar mist zelfstandigheid, diepgang of breedte.<br>• <b>Goed</b>: Toont zelfstandigheid, diepgang en relevantie; resultaten zijn praktisch toepasbaar en goed onderbouwd. <br><br><b>Aantonen niveau 2</b><br>• Minimaal 4 componenten: <b>Voldoende</b> of hoger.<br>• Maximaal 1 component: <b>Onvoldoende</b><br><br><b>Herstel</b><br>• <b>< 2 onvoldoendes:</b> Competentie kan hersteld worden.<br>• <b>> of = 2 onvoldoendes:</b> Competentie moet volledig opnieuw worden aangetoond.',
                'description_2' => '<b>Beoordelingsniveaus (HBO-i Domeinbeschrijving)</b><br>• <b>Niveau 1 (Taakgericht)</b>: De student voert duidelijke, afgebakende taken uit binnen het kader van de deliverables, zoals beschreven door de begeleiders.<br>• <b>Niveau 2 (Probleemgericht)</b>: De student formuleert zelfstandig problemen en methodologieën, werkt de deliverables uit met diepgang en past een onderzoekende houding toe.<br><br><b>De student toont niveau 2 wanneer hij/zij:</b><br>• Zelfstandig werkt: Complexe probleemstellingen definieert en methoden toepast zonder continue begeleiding.<br>• Verbanden legt: Combineert relevante gegevens en context om goed onderbouwde en logische conclusies te formuleren.<br>• Alternatieven en keuzes verantwoordt: Gemaakte keuzes en hun impact duidelijk onderbouwt.<br>• Stakeholders effectief betrekt: Actief belanghebbenden analyseert, met hen communiceert en hun feedback integreert.',
                'deliverable_text' => 'Plan van Aanpak en Onderzoeksrapport.',
                'deliverable_checked' => false,
                'knockoutCriteria' => [
                    [
                        'text' => 'Vertoont een aanzienlijk gebrek aan gestructureerdheid en samenhang',
                        'checked' => false,
                    ],
                    [
                        'text' => 'Maakt onvoldoende keuzes in bronnen,methoden,technieken',
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
                        'max_points' => 16,
                    ],
                    [
                        'label' => 'goed',
                        'min_points' => 17,
                        'max_points' => 25,
                    ],
                ],
            ],
            [
                'title' => 'Competentie Adviseren',
                'rows' => [
                    [
                        'component' => '<b>Stakeholders informeren</b>',
                        'description' => '<b>Onderzoeksrapport / Presentatie:</b><br>• Heldere beschrijving van de situatie.<br>• Gegevens en context afgestemd op doelgroep.',
                        'insufficient' => 'Situatie wordt onvolledig of onduidelijk beschreven; advies sluit niet aan bij doelgroep of verwachtingen.',
                        'sufficient' => 'Geeft advies gebaseerd op duidelijke richtlijnen; beschrijving is feitelijk maar beperkt in diepgang.',
                        'good' => 'Informeert stakeholders proactief en geeft advies dat helder is afgestemd op verschillende behoeften en verwachtingen.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                    [
                        'component' => '<b>Alternatieven en onderbouwing</b>',
                        'description' => '<b>Onderzoeksrapport:</b><br>• Beschrijving van alternatieven en bijbehorende voor- en nadelen.<br>• Gegronde keuzes en prioriteiten.',
                        'insufficient' => 'Alternatieven worden oppervlakkig benoemd of ontbreken; keuze is niet onderbouwd.',
                        'sufficient' => 'Bespreekt alternatieven met eenvoudige beschrijving van voor- en nadelen; keuzes zijn gebaseerd op standaardrichtlijnen.',
                        'good' => 'Onderzoekt en weegt alternatieven zelfstandig af; keuzes zijn goed onderbouwd en duidelijk verantwoord.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                    [
                        'component' => '<b>Technische analyse</b>',
                        'description' => '<b>Onderzoeksrapport / Technisch document:</b><br>• Analyse van bestaande systemen en frameworks.<br>• Beschrijving van technische vereisten.',
                        'insufficient' => 'Analyseert systemen of frameworks beperkt of foutief; technische vereisten worden onvolledig beschreven.',
                        'sufficient' => 'Analyseert systemen volgens richtlijnen; beschrijving van technische vereisten is volledig maar oppervlakkig.',
                        'good' => 'Voert een grondige analyse uit, evalueert meerdere frameworks of technologieën, en verantwoordt keuzes helder met praktijkvoorbeelden.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                    [
                        'component' => '<b>Advies voor systemen/tools</b>',
                        'description' => '<b>Onderzoeksrapport / Ontwerpdocument:</b><br>• Onderbouwd advies over te gebruiken systemen, frameworks, tools, of technologieën.',
                        'insufficient' => 'Advies is onvolledig of niet onderbouwd; houdt geen rekening met toekomstbestendigheid of schaalbaarheid.',
                        'sufficient' => 'Adviseert over systemen/tools op basis van gestructureerde analyse; keuze sluit aan bij opdrachtvereisten.',
                        'good' => 'Advies houdt rekening met toekomstbestendigheid, schaalbaarheid en integratie met andere systemen; is goed onderbouwd.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                    [
                        'component' => '<b>Ontwerpen of architectuur</b>',
                        'description' => '<b>Ontwerpdocument:</b><br>• Evaluatie van systeemarchitectuur of ontwerpen.<br>• Suggesties voor verbetering of uitbreiding.',
                        'insufficient' => 'Ontwerpen of suggesties zijn beperkt in toepasbaarheid of missen aansluiting bij opdrachtvereisten.',
                        'sufficient' => 'Geeft eenvoudige en toepasbare ontwerpverbeteringen; sluit aan bij de opdrachtvereisten.',
                        'good' => 'Geeft advies over innovatieve ontwerpen of architectuurverbeteringen die schaalbaarheid en efficiëntie bevorderen.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                ],
                'description_1' => '<b>Beoordelingsschaal</b><br>• <b>Onvoldoende</b>: Het advies mist helderheid, diepgang of onderbouwing; sluit niet aan bij de vraag of doelgroep.<br>• <b>Voldoende</b>: Het advies voldoet aan de basiscriteria; is correct, maar mist zelfstandigheid, diepgang of strategische impact.<br>• <b>Goed</b>: Advies toont zelfstandigheid, diepgang en praktische toepasbaarheid; keuzes zijn goed onderbouwd en afgestemd op de doelgroep.<br><br><b>Aantonen Niveau 2</b><br>• Minimaal 4 componenten: <b>Voldoende</b> of hoger.<br>• Maximaal 1 component: <b>Onvoldoende</b><br><br><b>Herstel</b><br>• <b>< 2 onvoldoendes:</b> Competentie kan worden hersteld.<br>• <b>≥ 2 onvoldoendes:</b> Competentie moet volledig opnieuw worden aangetoond',
                'description_2' => '<b>Beoordelingsniveaus (HBO-i Domeinbeschrijving)</b><br>• <b>Niveau 1 (Taakgericht)</b>: De student geeft advies binnen een duidelijk gedefinieerde context. Het advies is gebaseerd op analyses van beschikbare opties en richt zich op haalbare oplossingen die aansluiten bij de gestelde opdracht. Het advies beperkt zich tot directe toepassingen zonder diepgaande innovatie.<br>• <b>Niveau 2 (Probleemgericht)</b>: De student geeft advies dat verder gaat dan de opdracht en rekening houdt met bredere organisatorische of technologische implicaties. Het advies omvat het evalueren van meerdere opties, technische innovaties en een strategische onderbouwing.<br><br><b>De student toont niveau 2 als hij/zij:</b><br>• Frameworks en tools vergelijkt: Meerdere alternatieven evalueert en de keuze onderbouwt met een duidelijke impactanalyse.<br>• Toekomstgericht advies geeft: Oplossingen biedt die niet alleen huidige, maar ook toekomstige behoeften van de organisatie ondersteunen.<br>• Schaalbare ontwerpen adviseert: Advies bevat verbeteringen in architectuur of ontwerpen die bijdragen aan een robuust systeem.<br>• Effectief communiceert: Complexe aanbevelingen helder presenteert, ondersteund door diagrammen en schema\'s.',
                'deliverable_text' => 'Onderzoeksrapport (incl. hoofdstuk adviseren), Ontwerpdocument',
                'deliverable_checked' => false,
                'knockoutCriteria' => [
                    [
                        'text' => 'Vertoont een aanzienlijk gebrek aan gestructureerdheid en samenhang',
                        'checked' => false,
                    ],
                    [
                        'text' => 'Maakt onvoldoende keuzes in bronnen, methoden, technieken',
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
                'title' => 'Competentie Ontwerpen',
                'rows' => [
                    [
                        'component' => '<b>Vaststellen van requirements</b>',
                        'description' => '<b>Ontwerpdocument / Software Design Document:</b><br>• Functionele en niet-functionele eisen.<br>• Input vanuit stakeholders en contextanalyse.',
                        'insufficient' => 'Functionele eisen worden onvolledig of incorrect beschreven; niet-functionele eisen ontbreken.',
                        'sufficient' => 'Stelt functionele eisen correct vast op basis van een duidelijk kader; niet-functionele eisen zijn beperkt beschreven.',
                        'good' => 'Formuleert zelfstandig functionele en niet-functionele eisen op basis van complexe stakeholderscenario’s en context; dekkend en goed gestructureerd.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                    [
                        'component' => '<b>Architecturale keuzes en ontwerpprincipes</b>',
                        'description' => '<b>Ontwerpdocument / Software Design Document:</b><br>• Toelichting op de gekozen softwarearchitectuur.<br>• Toepassing van ontwerpprincipes en design patterns.',
                        'insufficient' => 'Architecturale keuzes worden niet of slecht onderbouwd; ontwerpprincipes worden niet toegepast of onjuist gebruikt.',
                        'sufficient' => 'Gemaakte keuzes zijn functioneel en gebaseerd op bekende principes; er is sprake van enige onderbouwing en toepassing van gangbare patronen.',
                        'good' => 'Gemaakte keuzes zijn goed onderbouwd; relevante ontwerpprincipes en patronen zijn doelgericht en correct toegepast; alternatieven worden afgewogen.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                    [
                        'component' => '<b>Technische haalbaarheid</b>',
                        'description' => '<b>Ontwerpdocument / Software Design Document:</b><br>• Toetsing van ontwerp aan technische mogelijkheden.<br>• Integratie met bestaande systemen.',
                        'insufficient' => 'Technische haalbaarheid is oppervlakkig of niet onderbouwd; integratie met bestaande systemen ontbreekt of is niet haalbaar.',
                        'sufficient' => 'Ontwerp is uitvoerbaar binnen het gespecificeerde kader; integratie met bestaande systemen wordt beschreven maar blijft beperkt.',
                        'good' => 'Integreert technisch haalbare oplossingen met een duidelijke onderbouwing; houdt rekening met beperkingen zoals kosten, resources en bestaande infrastructuur.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                    [
                        'component' => '<b>Structuur en documentatie</b>',
                        'description' => '<b>Ontwerpdocument / Software Design Document:</b><br>• Structuur toegebracht aan document.<br>• Beschrijving van structuur.',
                        'insufficient' => 'Structuur is onduidelijk of chaotisch; gebruik van standaarden zoals UML of ERD’s ontbreekt of is incorrect.',
                        'sufficient' => 'Ontwerp bevat de nodige documentatie; structuur is correct maar beperkt in visuele en technische kwaliteit.',
                        'good' => 'Documentatie is uitgebreid en visueel krachtig; gebruikt schema’s en diagrammen (zoals UML, ERD’s of wireframes) om complexiteit begrijpelijk te maken.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                    [
                        'component' => '<b>Validatie van ontwerp</b>',
                        'description' => '<b>Ontwerpdocument / Software Design Document:</b><br>• Afstemming met belanghebbenden.<br>• Overeenstemming met gestelde eisen.',
                        'insufficient' => 'Validatie met stakeholders is oppervlakkig of niet uitgevoerd; ontwerp sluit onvoldoende aan op gestelde eisen.',
                        'sufficient' => 'Ontwerp wordt afgestemd met een beperkt aantal stakeholders en voldoet aan basisvereisten; validatie wordt uitgevoerd volgens instructies.',
                        'good' => 'Voert uitgebreide validatie uit met belanghebbenden; past ontwerp actief aan op basis van feedback en garandeert afstemming met gestelde eisen.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                ],
                'description_1' => '<b>Beoordelingsschaal</b><br>• <b>Onvoldoende</b>: Basiscriteria worden niet gehaald; werk is onvolledig of incorrect uitgevoerd.<br>• <b>Voldoende</b>: Voldoet aan de minimale eisen; werk is correct maar mist zelfstandigheid, diepgang of strategische relevantie.<br>• <b>Goed</b>: Toont zelfstandigheid, diepgang en toepasbaarheid; werk is goed onderbouwd en afgestemd op context.<br><br><b>Aantonen Niveau 2</b><br>• Minimaal 4 componenten: <b>Voldoende</b> of hoger.<br>• Maximaal 1 component: <b>Onvoldoende</b><br><br><b>Herstel</b><br>• <b>< 2 onvoldoendes:</b> Competentie kan worden hersteld.<br>• <b>≥ 2 onvoldoendes:</b> Competentie moet volledig opnieuw worden aangetoond',
                'description_2' => '<b>Beoordelingsniveaus (HBO-i Domeinbeschrijving)</b><br>• <b>Niveau 1 (Taakgericht)</b>: De student werkt binnen een gegeven kader aan een ontwerp. Er is weinig ruimte voor eigen inbreng; de focus ligt op correcte toepassing van ontwerpprincipes en het naleven van gestelde eisen.<br>• <b>Niveau 2 (Probleemgericht)</b>: De student creëert zelfstandig ontwerpen die aansluiten op de complexe behoeften van een organisatie. Het ontwerp integreert functionele en technische eisen, en bevat creatieve oplossingen voor specifieke uitdagingen.<br><br><b>De student toont niveau 2 als hij/zij:</b><br>• Zelfstandig requirements opstelt: Functionele en niet-functionele eisen formuleert op basis van een uitgebreide analyse en stakeholderinput.<br>• Innovatief ontwerpt: Creatieve oplossingen biedt die verder gaan dan standaardmodellen en inspelen op specifieke uitdagingen.<br>• Validatie uitvoert: Feedback van verschillende belanghebbenden verwerkt en het ontwerp herzien op basis van deze input.<br>• Impact begrijpt: Rekening houdt met ethische en maatschappelijke implicaties en deze integreert in de ontwerpoplossing.',
                'deliverable_text' => 'Ontwerpdocument/ Software Design Document (SDD)',
                'deliverable_checked' => false,
                'knockoutCriteria' => [
                    [
                        'text' => 'Onvolledig ontwerp',
                        'checked' => false,
                    ],
                    [
                        'text' => 'Slechte code-structuur',
                        'checked' => false,
                    ],
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
                'title' => 'Competentie Realiseren',
                'rows' => [
                    [
                        'component' => '<b>Ontwikkeling van functionaliteit</b>',
                        'description' => '<b>Applicatie documentatie:</b><br>• Implementatie van voorgeschreven functionaliteiten.<br>• Gebruik van programmeerprincipes en frameworks.',
                        'insufficient' => 'Functionele eisen worden slechts gedeeltelijk geïmplementeerd; gebruik van programmeertechnieken is basaal of foutief.',
                        'sufficient' => 'Implementeert functionele eisen correct met eenvoudige programmeertechnieken en frameworks.',
                        'good' => 'Realiseert complexe functionaliteiten met gebruik van modulaire architectuur, geavanceerde technieken en frameworks.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                    [
                        'component' => '<b>Kwaliteit van de code</b>',
                        'description' => '<b>Applicatie documentatie:</b><br>• Gebruik van coding standards (bijv. SOLID, Clean Code).<br>• Documentatie van code en best practices.',
                        'insufficient' => 'Code is werkend, maar mist structuur en onderhoudbaarheid; coding standards worden niet of onjuist toegepast.',
                        'sufficient' => 'Schrijft werkende code met enige aandacht voor onderhoudbaarheid en standaardisatie; documentatie is minimaal maar aanwezig.',
                        'good' => 'Levert goed gestructureerde, onderhoudbare code met duidelijke documentatie; gebruikt coding standards zoals SOLID en Clean Code consistent.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                    [
                        'component' => '<b>Versiebeheer en samenwerking</b>',
                        'description' => '<b>Applicatie documentatie:</b><br>• Gebruik van versiebeheertools (bijv. Git).<br>• Samenwerking via pull requests en code reviews.',
                        'insufficient' => 'Werkt met versiebeheer volgens basisinstructies; weinig of geen interactie met teamleden bij pull requests en code reviews.',
                        'sufficient' => 'Gebruikt versiebeheer zelfstandig en correct, inclusief eenvoudige samenwerking via pull requests en reviews.',
                        'good' => 'Lost conflicten op, voert code reviews effectief uit en werkt proactief samen met teamleden via pull requests en iteratieve verbeteringen.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                    [
                        'component' => '<b>Testen en kwaliteitsborging</b>',
                        'description' => '<b>Applicatie documentatie:</b><br>• Uitvoering van unit tests en functionele tests.<br>• Verbetering van kwaliteit door debuggen en refactoring.',
                        'insufficient' => 'Basis tests worden uitgevoerd, maar missen dekking en consistentie; fouten worden alleen ad-hoc opgelost.',
                        'sufficient' => 'Voert basis tests uit en lost eenvoudige bugs op; begint met refactoring om kwaliteit te verbeteren.',
                        'good' => 'Voert uitgebreide tests uit, identificeert en lost complexe bugs op; past refactoring consistent toe om de codekwaliteit en prestaties te verbeteren.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                    [
                        'component' => '<b>Iteratieve oplevering</b>',
                        'description' => '<b>Applicatie documentatie:</b><br>• Opleveren van incrementele versies.<br>• Integreren van feedback in nieuwe iteraties.',
                        'insufficient' => 'Functionaliteit wordt slechts gedeeltelijk en in enkele iteraties opgeleverd; feedback wordt minimaal verwerkt.',
                        'sufficient' => 'Levert functionaliteit in beperkte iteraties; verwerkt feedback onder begeleiding.',
                        'good' => 'Levert functionaliteit in meerdere iteraties, integreert zelfstandig feedback en verbetert het product continu.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                ],
                'description_1' => '<b>Beoordelingsschaal</b><br>• <b>Onvoldoende</b>: Basiscriteria worden niet gehaald; werk is onvolledig of incorrect uitgevoerd.<br>• <b>Voldoende</b>: Voldoet aan de minimale eisen; werk is correct maar mist zelfstandigheid, diepgang of strategische relevantie.<br>• <b>Goed</b>: Toont zelfstandigheid, diepgang en toepasbaarheid; werk is goed onderbouwd en afgestemd op context.<br><br><b>Aantonen Niveau 2</b><br>• Minimaal 4 componenten: <b>Voldoende</b> of hoger.<br>• Maximaal 1 component: <b>Onvoldoende</b><br><br><b>Herstel</b><br>• <b>< 2 onvoldoendes:</b> Competentie kan worden hersteld.<br>• <b>≥ 2 onvoldoendes:</b> Competentie moet volledig opnieuw worden aangetoond',
                'description_2' => '<b>Beoordelingsniveaus (HBO-i Domeinbeschrijving)</b><br>• <b>Niveau 1 (Taakgericht)</b>: De student werkt binnen een vastgesteld kader aan de realisatie van een softwareoplossing. De focus ligt op het correct implementeren van functionaliteiten, met minimale aandacht voor optimalisatie of eigen inbreng.<br>• <b>Niveau 2 (Probleemgericht)</b>: De student realiseert zelfstandig een softwareoplossing die aansluit op complexe organisatorische behoeften. Hierbij worden geavanceerde technieken toegepast en is er een sterke focus op kwaliteit, schaalbaarheid en gebruiksvriendelijkheid.<br><br><b>De student toont niveau 2 als hij/zij:</b><br>• Zelfstandig complexe functionaliteiten ontwikkelt: Zoals integratie van API\'s, gebruik van frameworks, en implementatie van schaalbare oplossingen.<br>• Kwaliteitsnormen volgt: Past coding standards toe, schrijft modulaire code en zorgt voor gedocumenteerde oplossingen.<br>• Effectief test: Test en valideert code grondig met behulp van tools zoals unit testing frameworks (bijv. JUnit, pytest).<br>• Iteratief werkt: Levert incrementele verbeteringen en gebruikt feedback om functionaliteit te verfijnen.<br>• Gebruikersgerichte oplossingen realiseert: Functionaliteiten implementeert die inspelen op de behoeften van de eindgebruikers.',
                'deliverable_text' => 'Code van gemaakte software incl. demo opname en testcases',
                'deliverable_checked' => false,
                'knockoutCriteria' => [
                    [
                        'text' => 'Gebrek aan functionaliteiten',
                        'checked' => false,
                    ],
                    [
                        'text' => 'Onduidelijke demo/ ontbrekende demo',
                        'checked' => false,
                    ],
                    [
                        'text' => 'Ontbrekende testcases',
                        'checked' => false,
                    ],
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
                'title' => 'Competentie Manage & Control',
                'rows' => [
                    [
                        'component' => '<b>Planning en organisatie</b>',
                        'description' => '<b>Projectdefinitie:</b><br>• Realistische planning met mijlpalen.<br>• Beschrijving van taken, resources en deadlines.',
                        'insufficient' => 'Planning is onvolledig, onrealistisch, of niet afgestemd op de projectvereisten; taken en deadlines zijn niet gedefinieerd.',
                        'sufficient' => 'Volgt een opgegeven planning en voert basale aanpassingen door; mijlpalen zijn beschreven maar missen flexibiliteit.',
                        'good' => 'Ontwikkelt en beheert zelfstandig een dynamische planning met duidelijke mijlpalen; past deze actief aan op basis van voortgang en feedback.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                    [
                        'component' => '<b>Risicomanagement en Resourcebeheer</b>',
                        'description' => '<b>Projectdefinitie:</b><br>• Identificatie en analyse van risico\'s.<br>• Inschatting van benodigde tijd en middelen.',
                        'insufficient' => 'Risico’s worden niet herkend of slechts oppervlakkig geanalyseerd; resourcegebruik zijn onjuist of inefficiënt ingeschat; er ontbreken concrete maatregelen of optimalisatie.',
                        'sufficient' => 'Herkent risico’s en stelt basismaatregelen op met begeleiding; schat resources in op basis van richtlijnen, maar mist optimalisatie.',
                        'good' => 'Identificeert en analyseert zelfstandig risico’s en implementeert effectieve maatregelen; beheert tijd en middelen optimaal met oog voor efficiëntie, kosten en deadlines.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                    [
                        'component' => '<b>Communicatie met stakeholders</b>',
                        'description' => '<b>Projectdefinitie:</b><br>• Regelmatige updates aan belanghebbenden.<br>• Overzicht van acties en besluiten.',
                        'insufficient' => 'Updates aan stakeholders zijn onregelmatig of onduidelijk; acties en besluiten worden niet of nauwelijks vastgelegd.',
                        'sufficient' => 'Communiceert volgens instructies en deelt voortgang zonder extra context of analyse; acties worden minimaal gedocumenteerd.',
                        'good' => 'Communiceert proactief, stemt verwachtingen af met stakeholders en biedt duidelijke, relevante updates over voortgang, knelpunten en oplossingen.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                    [
                        'component' => '<b>Kwaliteitsbewaking</b>',
                        'description' => '<b>Projectdefinitie:</b><br>• Controle op tussenresultaten en naleving van normen.<br>• Evaluatie van het proces en verbeterpunten.',
                        'insufficient' => 'Kwaliteitscontroles zijn minimaal of ontbreken; feedback wordt niet gebruikt om processen of resultaten te verbeteren.',
                        'sufficient' => 'Voert kwaliteitscontroles uit volgens gestelde procedures; feedback wordt verwerkt maar leidt niet altijd tot verbeteringen.',
                        'good' => 'Stelt zelfstandig kwaliteitsnormen op, bewaakt tussenresultaten en implementeert verbeteringen op basis van feedback en evaluaties.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                    [
                        'component' => '<b>Afsluiting en evaluatie</b>',
                        'description' => '<b>Projectdefinitie / Reflectieverslag:</b><br>• Documentatie van projectresultaten.<br>• Reflectie op doelen en proces.',
                        'insufficient' => 'Projectresultaten worden onvolledig of chaotisch gedocumenteerd; reflectie is oppervlakkig of ontbreekt.',
                        'sufficient' => 'Sluit het project af volgens richtlijnen; reflectie bevat basisinzichten maar mist diepgang of verbeterpunten.',
                        'good' => 'Documenteert resultaten helder en overzichtelijk; reflecteert diepgaand op doelen, processen en stelt concrete verbeterpunten voor toekomstige projecten.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                ],
                'description_1' => '<b>Beoordelingsschaal</b><br>• <b>Onvoldoende</b>: Voldoet niet aan de basiscriteria; werk is onvolledig of mist inzicht en structuur.<br>• <b>Voldoende</b>: Voldoet aan de minimale eisen; werk is correct maar mist zelfstandigheid, diepgang of strategische relevantie.<br>• <b>Goed</b>: Toont zelfstandigheid, diepgang en toepasbaarheid; werk is goed onderbouwd en afgestemd op context.<br><br><b>Aantonen Niveau 2</b><br>• Minimaal 4 componenten: <b>Voldoende</b> of hoger.<br>• Maximaal 1 component: <b>Onvoldoende</b><br><br><b>Herstel</b><br>• <b>< 2 onvoldoendes:</b> Competentie kan worden hersteld.<br>• <b>≥ 2 onvoldoendes:</b> Competentie moet volledig opnieuw worden aangetoond',
                'description_2' => '<b>Beoordelingsniveaus (HBO-i Domeinbeschrijving)</b><br>• <b>Niveau 1 (Taakgericht)</b>: De student voert beheertaken uit binnen een vastgesteld kader. De focus ligt op het volgen van een planning, het uitvoeren van basisprojectmanagementtaken en het reageren op aanwijzingen van begeleiders.<br>• <b>Niveau 2 (Probleemgericht)</b>: De student neemt zelfstandig verantwoordelijkheid voor de planning, organisatie en controle van een project. Dit omvat het anticiperen op risico\'s, proactieve communicatie en het aanpassen van plannen op basis van veranderende omstandigheden.<br><br><b>De student toont niveau 2 als hij/zij:</b><br>• Zelfstandig planningen beheert: Inclusief het anticiperen op veranderingen en het aanpassen van plannen op basis van voortgang en feedback.<br>• Proactief risico\'s identificeert en beheerst: Analyseert risico\'s en implementeert passende maatregelen.<br>• Effectief communiceert: Verzorgt regelmatige updates aan stakeholders met relevante analyses en duidelijke acties.<br>• Kwaliteit waarborgt: Voert controles uit op processen en resultaten, en implementeert verbeteringen op basis van evaluaties.',
                'deliverable_text' => 'Projectdefinitie, Bewijsstukken van gebruikte projectmethodiek + readme, overdrachtsdocumenten, eindverslag',
                'deliverable_checked' => false,
                'knockoutCriteria' => [
                    [
                        'text' => 'Ontbrekende projectmethodiek',
                        'checked' => false,
                    ],
                    [
                        'text' => 'Onvolledige overdrachtsdocumenten',
                        'checked' => false,
                    ],
                    [
                        'text' => 'Zwakke reflectie in het eindverslag',
                        'checked' => false,
                    ],
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
                'title' => 'Competentie Professionele Skills',
                'rows' => [
                    [
                        'component' => '<b>Samenwerking</b>',
                        'description' => '<b>Reflectieverslag /Bedrijfsevaluatie:</b><br>• Bijdrage aan teamdoelen.<br>• Effectieve interactie met teamleden en stakeholders.',
                        'insufficient' => 'Toont af en toe initiatief, maar aarzelt om verantwoordelijkheid te nemen.',
                        'sufficient' => 'Neemt regelmatig initiatief, is bereid verantwoordelijkheid te dragen voor toegewezen taken.',
                        'good' => 'Vertoont consistent ondernemend gedrag, toont leiderschapskwaliteiten.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                    [
                        'component' => '<b>Communicatie</b>',
                        'description' => '<b>Reflectieverslag /Bedrijfsevaluatie/ archief oplevering:</b><br>• Heldere rapportage en presentaties.<br>• Aansluiten bij doelgroep en situatie.',
                        'insufficient' => 'Toont enige interesse, maar investeert minimaal in zelfverbetering.',
                        'sufficient' => 'Streeft actief naar persoonlijke ontwikkeling en toont bereidheid om nieuwe vaardigheden te leren.',
                        'good' => 'Onderneemt systematische inspanningen voor continue groei en ontwikkeling.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                    [
                        'component' => '<b>Reflectie en feedback</b>',
                        'description' => '<b>Reflectieverslag:</b><br>• Zelfreflectie op professioneel handelen.<br>• Gebruik van feedback voor verbetering.',
                        'insufficient' => 'Toont enig begrip van normen en waarden, maar reageert inconsistent op ethische dilemma.',
                        'sufficient' => 'Handelt over het algemeen ethisch en demonstreert respect voor diversiteit.',
                        'good' => 'Toont geavanceerd inzicht in ethiek, handelt consequent volgens normen en waarden, beheert culturele verschillen effectief.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                    [
                        'component' => '<b>Tijdmanagement</b>',
                        'description' => '<b>Projectdefinitie/ Reflectieverslag:</b><br>• Prioriteiten stellen en omgaan met deadlines.<br>• Beheersing van eigen werkdruk.',
                        'insufficient' => 'Toont enig inzicht, maar mist cohesie bij het begrijpen van organisatorische structuren en processen. ',
                        'sufficient' => 'Begrijpt de organisatorische context en principes van management.',
                        'good' => 'Kan de organisatie effectief managen, toont leiderschap bij het begrijpen van de organisatorische context.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                    [
                        'component' => '<b>Persoonlijke effectiviteit</b>',
                        'description' => '<b>Reflectieverslag /Bedrijfsevaluatie/ archief:</b><br>• Zelfstandigheid, initiatief en doorzettingsvermogen.',
                        'insufficient' => 'Toont enig vermogen om problemen te herkennen, maar heeft moeite met systematische probleemaanpak.',
                        'sufficient' => 'Identificeert en analyseert effectief problemen, stelt haalbare oplossingen voor.',
                        'good' => 'Biedt innovatieve oplossingen aan, kan complexe problemen effectief oplossen.',
                        'points' => 0,
                        'remarks' => '',
                    ],
                ],
                'description_1' => '<b>Beoordelingsschaal</b><br>• <b>Onvoldoende</b>: Basiscriteria worden niet gehaald; gedrag is reactief en mist zelfstandigheid of diepgang.<br>• <b>Voldoende</b>: Voldoet aan de minimale eisen; werk is correct maar mist zelfstandigheid, diepgang of strategische relevantie.<br>• <b>Goed</b>: Toont zelfstandigheid, diepgang en toepasbaarheid; werk is goed onderbouwd en afgestemd op context.<br><br><b>Aantonen Niveau 2</b><br>• Minimaal 4 componenten: <b>Voldoende</b> of hoger.<br>• Maximaal 1 component: <b>Onvoldoende</b><br><br><b>Herstel</b><br>• <b>< 2 onvoldoendes:</b> Competentie kan worden hersteld.<br>• <b>≥ 2 onvoldoendes:</b> Competentie moet volledig opnieuw worden aangetoond',
                'description_2' => '<b>Beoordelingsniveaus (HBO-i Domeinbeschrijving)</b><br>• <b>Niveau 1 (Taakgericht)</b>: De student toont een basisniveau van professionele vaardigheden door te werken binnen gestelde kaders. Samenwerking en communicatie zijn functioneel, maar voornamelijk reactief. Reflectie is aanwezig, maar beperkt tot het benoemen van eigen handelen zonder concrete verbeteracties.<br>• <b>Niveau 2 (Probleemgericht)</b>: De student laat een hoge mate van professionaliteit zien door actief bij te dragen aan samenwerking en effectieve communicatie. Reflectie is diepgaand en leidt tot persoonlijke groei. De student toont ethisch bewustzijn en handelt proactief in complexe situaties.<br><br><b>De student toont niveau 2 als hij/zij:</b><br>• Leiderschap en samenwerking laat zien: Actief bijdraagt aan teamdoelen en effectief omgaat met spanningen of problemen binnen teams.<br>• Effectief communiceert: Complexe informatie vertaalt naar duidelijke, toegankelijke communicatie voor verschillende belanghebbenden.<br>• Zelfreflectie en groei toont: Feedback actief verwerkt in een plan van aanpak en verbeteringen doorvoert.<br>• Persoonlijk effectief is: Zelfstandig beslissingen neemt, initiatief toont en uitdagingen doortastend aanpakt.',
                'deliverable_text' => 'Alle deliverables (Projectdefinitie, Plan van Aanpak, Onderzoeksrapport (incl. hoofdstuk adviseren), Functioneel ontwerpdocument, Code van gemaakte software incl. demo opname en testcases, Bewijsstukken van gebruikte projectmethodiek + readme, overdrachtsdocumenten, eindverslag)',
                'deliverable_checked' => false,
                'knockoutCriteria' => [
                    [
                        'text' => 'Gebrek aan professionele houding',
                        'checked' => false,
                    ],
                    [
                        'text' => 'Gebrek aan samenwerking',
                        'checked' => false,
                    ],
                    [
                        'text' => 'Gebrek aan communicatie',
                        'checked' => false,
                    ],
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
//            'start_period' => '',
            'start_period' => null,
//            'end_period' => '',
            'end_period' => null,
            'oe_code' => '',
            'title_assignment' => '',
            'retry' => false,
//            'grading_date' => '',
            'grading_date' => null,
            'assignment_id' => 1
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
