<p align="center"><img src="https://www.summacollege.nl/images/default-source/default-album/logo.png?sfvrsn=17f34f85_6/" width="400"></a></p>


## Project 4 (leerjaar 2022)
### Summa College opleiding Software Development
Het project is onderdeel van de opliedig software developer. In dit project kun je aantonen dat je de voorgaande modules onder controle hebt. 

## Opnieuw pizza's
De context van het project is opnieuw een pizzaleverancier. Jouw klant is een pizzatent die online pizza verkoopt, op een locatie bereidt en ze daarna via een koerier thuis aflevert. De klant heet "Stonks Pizza"
Ze hadden het bedrijf "The Shabby Mess Makers(SMM)" de opdracht gegeven om een applicatie en website te maken. Helaas heeft SMM zich met een grote som geld uit de voeten gemaakt zonder iets te leveren. Dus het aan jullie om er nog iets van te maken. 
Ze gaan over 5 weken open en dus zal er snel iets geleverd moeten worden.

## Wat is er
Er zijn een groot aantal user stories die je kunt verdelen over je product team. Jouw leidinggevende wil dat je zowel bezig bent met web als met applicatie(C#) onderdelen. Dus het is niet de bedoeling dat 1 persoon de website maakt en 1 persoon de applicatie.

### Opzet
1. Bekijk alles wat je hebt (dag 1)
2. Zorg voor een goede ontwikkelomgeving en beschrijf die in een document (dag 1).
3. Zorg voor een goede testomgeving enb beschrijf die in een document (dag 1).
4. Zorg voor een goede projectomgeving (dag 1).
5. Maak een werkverdeling van de taken voor alle projectleden (dag 1).
6. Maak een gedetailleerde planning voor de eerste week en zorg er voor dat je al user stories af krijgt (dag 1).
7. Zorg er voor dat jouw werk in een eigen github repo terecht komt (week 1).

## Hoe te gebruiken
Deze repo is een standaard laravel app met breeze en een pakket Laravel-permission (voor roles and permissions). Breeze is de component die gebruikt wordt voor authenticatie. Alle migrations zijn al aanwezig en er is een seed gemaakt (testdata).
Je kunt deze repo clonen op je eigen systeem met het commando:
git clone  https://github.com/summacollege/project4.git

Zodra je dat hebt gedaan kun je de .git folder weggooien en je eigen git repo aanmaken (en eigen github repo).
Natuurlijk moet je nog wat commando's en gebruiken om de boel aan de gang te krijgen en natuurlijk ook je .env weer aanmaken.
- composer update
- npm install && npm run dev
- rename .env.example naar .env
- maak database project4 en maak juiste instellingen in .env
- maak laravel key aan met commando: php artisan key:generate
- run php artisan migrate --seed


## Dit project mag/kun je gebruiken als startpunt.

Werkwijze:
- maak voor iedere persoon in de applicatie een user aan en geef die een rol
- de rollen en permissions zijn al aangemaakt in de database seeder:'balie', 'bereiding, 'bezorger', 'klant', 'management'
  - $user = User::create['' => '']
  - $user->assignRole('bereiding');
- voor elke rol is momenteel één permission. Maar dit kan worden uitgebreid.
- gebruik in een view bijvoorbeeld:
  - @can('betsellen') (dit mag een klant)  @endcan
- klanten kunnen via een registratie systeem zichzelf als user aanmaken (achter de schermen word ook meteen een person record aangemaakt)
  - wanner ze een aankoop gaan doen kunnen ze extra informatie invullen (of je zou de profile pagina kunnen uitbreiden)
- bij het aanmaken moet je wel een juiste rol 'assignen' (dit is al in de code gebeurt)
- werkwijze voor personeel:
  - melden zich eerst aan via register
  - management zoekt daarna user en verandert de rol
  - personeel moet daarna extra info invullen

- dus er moet een start account zijn:admin (zie seeder)
- hiermee kun je management maken en management kan de rest maken


## License
Dit project is gemaakt met het framework laravel.
Het project wordt vrijgegeven onder MIT licentie.
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
