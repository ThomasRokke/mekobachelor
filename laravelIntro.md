# Laravel Introduksjon

Under vår bacheloroppgave skal vi utvikle en applikasjon ved hjelp av rammeverket Laravel. Siden kun et på gruppen har erfaring med Laravel så skal vi gå igjennom funksjonalitet som gjør teamet rustet til å utvikle front-end deler av applikasjonen. 

### Starte prosjektet lokalt
Vi har allerede installert og konfigruert prosjektet i felleskap. For å starte det på din lokale maskin,
naviger fra "mekobachelor" inn i mappen "App" ved hjelp av terminalen. 
Skriv kommandoen "php artisan serve" for å starte en lokal server. 
```
php artisan serve
```
Applikasjonen kobles til din lokale MySQL server ved hjelp av brukernavn og passord du har definert 
i .env filen som vi opprettet under installasjonen. 

##### Ved feilmeldinger
Sjekk at du ikke allerede har starten en lokal server. Det kan du finne ut ved
 å se om nettsiden svarer på localhost:8000. For å stoppe serveren forsøk å
  lukke kommandovinduet. Om nettsiden kjører men du får feilmeldinger knyttet
   til SQL spørringer ved innlogging/registrering, undersøk at din lokale MySQL server kjører. Det kan du se
    i MySQL Workbench.  Om 10-15 minutter på StackoverFlow og Laravel dokumentasjon ikke gjør susen så kontakt meg ASAP.
     Det kan fort hende jeg har vært borte i samme problem tidligere. 


### Mappestruktur
<ul>

<li><a target="_blank" href="https://laravel.com/docs/5.7/structure#the-root-directory">The Root Directory</a>
<ul>
<li><a target="_blank" href="https://laravel.com/docs/5.7/structure#the-root-app-directory">The <code class=" language-php">app</code> Directory</a></li>
<li><a target="_blank" href="https://laravel.com/docs/5.7/structure#the-bootstrap-directory">The <code class=" language-php">bootstrap</code> Directory</a></li>
<li><a target="_blank" href="https://laravel.com/docs/5.7/structure#the-config-directory">The <code class=" language-php">config</code> Directory</a></li>
<li><a target="_blank" href="https://laravel.com/docs/5.7/structure#the-database-directory">The <code class=" language-php">database</code> Directory</a></li>
<li><a target="_blank" href="https://laravel.com/docs/5.7/structure#the-public-directory">The <code class=" language-php"><span class="token keyword">public</span></code> Directory</a></li>
<li><a target="_blank" href="https://laravel.com/docs/5.7/structure#the-resources-directory">The <code class=" language-php">resources</code> Directory</a></li>
<li><a target="_blank" href="https://laravel.com/docs/5.7/structure#the-routes-directory">The <code class=" language-php">routes</code> Directory</a></li>
<li><a target="_blank" href="https://laravel.com/docs/5.7/structure#the-storage-directory">The <code class=" language-php">storage</code> Directory</a></li>
<li><a target="_blank" href="https://laravel.com/docs/5.7/structure#the-tests-directory">The <code class=" language-php">tests</code> Directory</a></li>
<li><a target="_blank" href="https://laravel.com/docs/5.7/structure#the-vendor-directory">The <code class=" language-php">vendor</code> Directory</a></li>
</ul></li>
<li><a target="_blank" href="https://laravel.com/docs/5.7/structure#the-app-directory">The App Directory</a>
<ul>
<li><a target="_blank" href="https://laravel.com/docs/5.7/structure#the-broadcasting-directory">The <code class=" language-php">Broadcasting</code> Directory</a></li>
<li><a target="_blank" href="https://laravel.com/docs/5.7/structure#the-console-directory">The <code class=" language-php">Console</code> Directory</a></li>
<li><a target="_blank" href="https://laravel.com/docs/5.7/structure#the-events-directory">The <code class=" language-php">Events</code> Directory</a></li>
<li><a target="_blank" href="https://laravel.com/docs/5.7/structure#the-exceptions-directory">The <code class=" language-php">Exceptions</code> Directory</a></li>
<li><a target="_blank" href="https://laravel.com/docs/5.7/structure#the-http-directory">The <code class=" language-php">Http</code> Directory</a></li>
<li><a target="_blank" href="https://laravel.com/docs/5.7/structure#the-jobs-directory">The <code class=" language-php">Jobs</code> Directory</a></li>
<li><a target="_blank" href="https://laravel.com/docs/5.7/structure#the-listeners-directory">The <code class=" language-php">Listeners</code> Directory</a></li>
<li><a target="_blank" href="https://laravel.com/docs/5.7/structure#the-mail-directory">The <code class=" language-php">Mail</code> Directory</a></li>
<li><a target="_blank" href="https://laravel.com/docs/5.7/structure#the-notifications-directory">The <code class=" language-php">Notifications</code> Directory</a></li>
<li><a target="_blank" href="https://laravel.com/docs/5.7/structure#the-policies-directory">The <code class=" language-php">Policies</code> Directory</a></li>
<li><a target="_blank" href="https://laravel.com/docs/5.7/structure#the-providers-directory">The <code class=" language-php">Providers</code> Directory</a></li>
<li><a target="_blank" href="https://laravel.com/docs/5.7/structure#the-rules-directory">The <code class=" language-php">Rules</code> Directory</a></li>
</ul></li>
</ul>

Foreløpig trenger dere kun å forholde dere til <a target="_blank" href="https://laravel.com/docs/5.7/structure#the-public-directory">Public</a>, <a target="_blank" href="https://laravel.com/docs/5.7/structure#the-resources-directory">Resources</a>
 og <a target="_blank" href="https://laravel.com/docs/5.7/structure#the-routes-directory">Routes</a>.
 
#### Public
Mappen består av CSS, JS og IMG som inneholder tilhørende ressurser vi benytter på nettsiden. 

#### Resources
Her vil alle "Views" ligge. Det benyttes Blade templating engine som blander ren html og php, men dere trenger kun å forholde dere til HTML. 

#### Routing
Routing tar hånd om hva som skal skje når en request blir sendt til serveren. Når jeg skriver www.placeholder/stuff vil routing funksjonen for filstien url->stuff bli aktivert. Vi trenger kun å forholde oss til filen web.php som. 

# Øvelse
#### Opprett din personlige side

##### Step 1
Opprett et View i mappen Resources/View som du kaller dittnavn.blade.php

##### Step 2
Benytt Layout med navn 'newtest' og fyll nettsiden med tre Bootstrap Komponenter fra dokumentasjonen. PS: Se på de andre filene for hint om oppsett.

```
@extends('layouts.dittnavn')

@section('content')
    <!-- DIN HTML -->
@endsection
```



##### Step 3
Opprett en routing GET funksjon i Routes/web.php

```
Route::get('/dittnavn', function () {
    return view('dittnavn');
});
```


##### Step 4
Push alle endringer til GIT. 

```
git pull
git add .
git commit -m "dittnavn har fullført introtest"
git push
```




 
