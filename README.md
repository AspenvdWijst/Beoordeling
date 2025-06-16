Fijn dat uw ons product in handen neemt. Hieronder zal een kleine uitleg staan die ervoor zorgt dat u het product naar behoren kan gebruiken. Als u de volgende stappen opvolgt kunt u er gelijk mee aan de slag:

<b>-Stap 1:</b> Download de zip file en pak het uit.<br><br>
<b>-Stap 2:</b> Open het project in je IDE naar keuze.<br><br>
<b>-Stap 3:</b> In de terminal typt 'composer install'. Dit zal de juiste packages installeren dat alles zal werken.<br><br>
<b>-Stap 4:</b> Als dit afgehandeld is typt u in de terminal 'npm install' en vervolgens 'npm run build'.<br><br>
<b>-Stap 5:</b> In het 'env.example' bestand vult u uw eigen sqlite database naam in en haalt u .example weg. Zo kunt u de data goed opslaan. <b>!!Belangrijk: gebruik sqlite als uw database type. andere databases zoals msql zullen problemen opleveren!!</b><br><br>
<b>-Stap 6:</b> Voor een laravel project moet een sleutel aangemaakt worden. Schrijf daarom in de terminal 'php artisan key:generate'.<br><br>
<b>-Stap 7:</b> terug in de terminal schrijft u het volgende 'php artisan migrate'. Dit zal de database opzetten.<br><br>
<b>-Stap 8:</b> Nu kunt u in de terminal 'php artisan migrate:fresh --seed' typen wat de database zal vullen met data.<br><br>
<b>-Stap 9:</b> Mocht u toevallig de testen willen uitvoeren typt u in de terminal nu 'php artisan test'. Dit zal alle testen uitvoeren <b>!!Belangrijk: dit leegt de database weer van data. Om hierna verder te gaan moet u weer 'php artisan migrate:fresh --seed' typen in de terminal om de database te vullen!!</b><br><br>
<b>-Stap 10:</b> Mocht u de testen niet willen uitvoeren kunt u nu 'php artisan serve' in de terminal doen wat het lokaal laat starten.<br><br>
<b>-Stap 11:</b> Gefeliciteerd!! Het product is nu klaar voor gebruik :)<br><br>
Inloggegevens: admin@windesheim.nl - ww: admin<br>, teacher@windesheim.nl - ww: teacher<br>, teacher2@windesheim.nl - ww: teacher2<br>,student@windesheim.nl - ww: student 
